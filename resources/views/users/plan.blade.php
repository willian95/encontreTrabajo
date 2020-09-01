@extends("layouts.user")

@section("content")

    <div class="row">
        @foreach(App\Plan::all() as $plan)

            <div class="col-md-4 col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center title-plan">{{ $plan->title }}</h3>

                        <p><strong>Publicaciones: </strong>{{ $plan->post_amount }}</p>
                        <p><strong>Conferencias: </strong>{{ $plan->conference_amount }}</p>

                        <h4 class="text-center price-plan">$ {{ number_format($plan->price, 0, ",", ".") }}</h4>


                        <p class="text-center">
                            <button class="btn btn-success">Comprar</button>
                        </p>
                    </div>
                </div>

            </div>

        @endforeach
    </div>

@endsection