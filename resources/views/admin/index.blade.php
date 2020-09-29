@extends("layouts.admin")

@section("content")

    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Dashboard-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-xl-4">
                    <!--begin::Tiles Widget 8-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <div class="card-title">
                                <div class="card-label">
                                    <div class="font-weight-bolder">Estadíscticas</div>
                                </div>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column p-0">
                            <!--begin::Items-->
                            <div class="flex-grow-1 card-spacer">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center justify-content-between mb-10">
                                    <div class="d-flex align-items-center mr-2">
                                        <div class="symbol symbol-40 symbol-light-primary mr-3 flex-shrink-0">
                                            <div class="symbol-label">
                                                <span class="svg-icon svg-icon-lg svg-icon-primary">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z" fill="#000000" />
                                                            <rect fill="#000000" opacity="0.3" transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)" x="16.3255682" y="2.94551858" width="3" height="18" rx="1" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Ofertas</a>
                                        </div>
                                    </div>
                                    <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">{{ App\Offer::count() }}</div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center justify-content-between mb-10">
                                    <div class="d-flex align-items-center mr-2">
                                        <div class="symbol symbol-40 symbol-light-warning mr-3 flex-shrink-0">
                                            <div class="symbol-label">
                                                <span class="svg-icon svg-icon-lg svg-icon-warning">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Devices/Mic.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M12.9975507,17.929461 C12.9991745,17.9527631 13,17.9762852 13,18 L13,21 C13,21.5522847 12.5522847,22 12,22 C11.4477153,22 11,21.5522847 11,21 L11,18 C11,17.9762852 11.0008255,17.9527631 11.0024493,17.929461 C7.60896116,17.4452857 5,14.5273206 5,11 L7,11 C7,13.7614237 9.23857625,16 12,16 C14.7614237,16 17,13.7614237 17,11 L19,11 C19,14.5273206 16.3910388,17.4452857 12.9975507,17.929461 Z" fill="#000000" fill-rule="nonzero" />
                                                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) rotate(-360.000000) translate(-12.000000, -8.000000)" x="9" y="2" width="6" height="12" rx="3" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Usuarios</a>
                                        </div>
                                    </div>
                                    <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">{{ App\User::where("role_id", 2)->count() }}</div>
                                </div>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <div class="d-flex align-items-center justify-content-between mb-10">
                                    <div class="d-flex align-items-center mr-2">
                                        <div class="symbol symbol-40 symbol-light-success mr-3 flex-shrink-0">
                                            <div class="symbol-label">
                                                <span class="svg-icon svg-icon-lg svg-icon-success">
                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group-chat.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24" />
                                                            <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000" />
                                                            <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3" />
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </div>
                                        </div>
                                        <div>
                                            <a href="#" class="font-size-h6 text-dark-75 text-hover-primary font-weight-bolder">Empresas</a>
                                        </div>
                                    </div>
                                    <div class="label label-light label-inline font-weight-bold text-dark-50 py-4 px-3 font-size-base">{{ App\User::where("role_id", 3)->count() }}</div>
                                </div>
                                <!--end::Item-->
                            </div>
                            <!--end::Items-->
                            <!--begin::Chart-->
                            <!--<div id="kt_tiles_widget_8_chart" class="card-rounded-bottom" data-color="warning" style="height: 150px"></div>-->
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Tiles Widget 8-->
                </div>
                <div class="col-xl-8">
                    <!--begin::Advance Table Widget 10-->
                    <div class="card card-custom gutter-b card-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label font-weight-bolder text-dark">Nuevas ofertas</span>

                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body py-0">
                            <!--begin::Table-->
                            <div class="table-responsive">
                                <table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_4">
                                    <thead>
                                        <tr class="text-left">
                                            <th class="pl-0" style="min-width: 120px">Titulo</th>
                                            <th style="min-width: 110px">Puesto</th>
                                            <th style="min-width: 110px">
                                                Empresa
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(App\Offer::with("user")->has("user")->take(4)->get() as $offer)
                                            <tr>
                                                <td class="pl-0">
                                                    {{ $offer->title }}
                                                </td>
                                                <td>
                                                    {{ $offer->job_position }}
                                                </td>
                                                <td> 
                                                    {{ $offer->user->business_name }}
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!--end::Table-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Advance Table Widget 10-->
                </div>
            </div>
            
            <!--end::Row-->
            <!--end::Dashboard-->
        </div>
        <!--end::Container-->
    </div>

@endsection