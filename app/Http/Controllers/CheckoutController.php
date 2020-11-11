<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Freshwork\Transbank\WebpayNormal;
use Freshwork\Transbank\WebpayPatPass;
use Freshwork\Transbank\RedirectorHelper;
use Carbon\Carbon;
use App\serviceAmount;
use App\Cart;
use App\Payment;
use App\Plan;

class CheckoutController extends Controller
{
    
    public function initTransaction(WebpayNormal $webpayNormal, $index)
	{   
        $cart = Cart::where("index", $index)->first();
        session_start();
        $_SESSION["index"] = $index;

        $order = uniqid()."-".rand(1000, 9999);

        $webpayNormal->addTransactionDetail($cart->price, $order);  
		$response = $webpayNormal->initTransaction(route('checkout.webpay.response'), route('checkout.webpay.finish')); 
		// Probablemente también quieras crear una orden o transacción en tu base de datos y guardar el token ahí.
        $payment = new Payment;
        $payment->order_id = $order;
        $payment->user_id = \Auth::user()->id;
        $payment->plan_id = $cart->plan_id;
        $payment->price = $cart->price;
        $payment->save();

		return RedirectorHelper::redirectHTML($response->url, $response->token);
    }
    
    public function response(WebpayPatPass $webpayPatPass)  
	{  
        $result = $webpayPatPass->getTransactionResult();  
        session_start();
        $_SESSION["response"] = $result;
        $webpayPatPass->acknowledgeTransaction();
        // Revisar si la transacción fue exitosa ($result->detailOutput->responseCode === 0) o fallida para guardar ese resultado en tu base de datos. 
        
        return RedirectorHelper::redirectBackNormal($result->urlRedirection);  
	}

	public function finish()  
	{   

        session_start();   
        $response = $_SESSION["response"];

        if($response->detailOutput->responseCode == 0){

            $payment = Payment::where("order_id", $response->buyOrder)->first();
            $payment->status = "aprobado";
            $payment->update();

            $plan = Plan::where("id", $payment->plan_id)->first();

            $serviceAmount = serviceAmount::where("user_id", $payment->user_id)->first();
            $serviceAmount->simple_post_amount = $serviceAmount->simple_post_amount + $plan->simple_posts;
            $serviceAmount->highlighted_post_amount = $serviceAmount->highlighted_post_amount + $plan->hightlight_posts;
            $serviceAmount->conference_amount = $serviceAmount->conference_amount + $plan->conference_amount;
            $serviceAmount->download_profiles_amount = $serviceAmount->download_profiles_amount + $plan->download_profiles;
            
            if($plan->plan_time == "anuales" && $plan->simple_post_infinity == 1){
                $serviceAmount->due_time = Carbon::now()->addYear();
            }else if($plan->plan_time == "semestrales" && $plan->simple_post_infinity == 1){
                $serviceAmount->due_time = Carbon::now()->addMonths(6);
            }

            if($plan->plan_time == "anuales" && $plan->conference_infinity == 1){
                $serviceAmount->conference_infinity_due_time = Carbon::now()->addYear();
            }else if($plan->plan_time == "semestrales" && $plan->conference_infinity == 1){
                $serviceAmount->conference_infinity_due_time = Carbon::now()->addMonths(6);
            }

            $serviceAmount->update();

            return view("users.successPayment");

        }else{

            return view("users.rejectedPayment");

        }

        
        // Acá buscar la transacción en tu base de datos y ver si fue exitosa o fallida, para mostrar el mensaje de gracias o de error según corresponda
	}

}
