<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use App\Country;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $countries = [
            [
                "id" => 1,
                "name" => "Argentina",
                "abbr" => "AR"
            ],
            [
                "id" => 2,
                "name" => "Bolivia",
                "abbr" => "BOB"
            ],
            [
                "id" => 3,
                "name" => "Brasil",
                "abbr" => "BR"
            ],
            [
                "id" => 4,
                "name" => "Chile",
                "abbr" => "CL"
            ],
            [
                "id" => 5,
                "name" => "Colombia",
                "abbr" => "CO"
            ],
            [
                "id" => 6,
                "name" => "Ecuador",
                "abbr" => "EC"
            ],
            [
                "id" => 7,
                "name" => "Guyana",
                "abbr" => "GY"
            ],
            [
                "id" => 8,
                "name" => "Guayana Francesa",
                "abbr" => "GF"
            ],
            [
                "id" => 9,
                "name" => "Paraguay",
                "abbr" => "PY"
            ],
            [
                "id" => 10,
                "name" => "Perú",
                "abbr" => "PE"
            ],
            [
                "id" => 11,
                "name" => "Surinam",
                "abbr" => "SR"
            ],
            [
                "id" => 12,
                "name" => "Trinidad y Tobago",
                "abbr" => "TT"
            ],
            [
                "id" => 13,
                "name" => "Uruguay",
                "abbr" => "UY"
            ],
            [
                "id" => 14,
                "name" => "Venezuela",
                "abbr" => "VE"
            ]
        ];

        foreach($countries as $country){

            //Log::info("country: ".$country["name"]);

            if($this->checkId($country["id"])){
                $countryData = new Country;
                $countryData->name = $country["name"];
                $countryData->abbr = $country["abbr"];
                $countryData->save();
            }

        }



    }

    function checkId($id){

        $country = Country::where("id", $id)->first();
        if($country == null){
            return true;
        }else{
            return false;
        }

    }

}
