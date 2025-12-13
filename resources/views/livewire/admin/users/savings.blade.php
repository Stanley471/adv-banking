<div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row">
                @if(getSavingCircles()->count() || $client->savings('all', 'circle')->count())
                <div class="col-md-12 mb-6">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_circle_button">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-users fa-2x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-4 mt-4 d-block">{{__('Saving Circles')}}</p>
                        <p class="fs-1 fw-bolder text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($client->savings('all', 'circle')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Active Plans: ').$client->savings('all', 'circle')->count()}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Total Saved: ').$currency->currency_symbol.currencyFormat(number_format($client->totalSavings('circle')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($client->totalSavingsReturn('circle')->sum('amount'), 2)).' '.$currency->currency}}</p>
                    </div>
                </div>
                <div id="kt_circle_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_circle_button" data-kt-drawer-close="#kt_circle_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Saving Circles')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_duo_close">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fal fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-wrap">
                            <div class="btn-wrapper text-center mb-3">
                                <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                                    <div class="symbol-label fs-1 text-dark bg-light-info">
                                        <i class="fal fa-users fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @forelse($client->savings('all', 'circle')->get() as $circle)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$circle->circle->image}})"></div>
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$circle->circle->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($circle->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('admin.save.manage', ['plan' => $circle->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-600 text-center">{{__('No Active Plans')}}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($set->rss || $client->savings('all', 'regular')->count())
                <div class="col-md-12 mb-6">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_regular_button">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-sync fa-2x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-4 mt-4 d-block">{{__('Regular Savings')}}</p>
                        <p class="fs-1 fw-bolder text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($client->savings('active', 'regular')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Active plans: ').$client->savings('active', 'regular')->count()}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Total Saved: ').$currency->currency_symbol.currencyFormat(number_format($client->totalSavings('regular')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($client->totalSavingsReturn('regular')->sum('amount'), 2)).' '.$currency->currency}}</p>
                    </div>
                </div>
                <div id="kt_regular_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_regular_button" data-kt-drawer-close="#kt_regular_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Regular Savings')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_regular_close">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fal fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-wrap">
                            <div class="btn-wrapper text-center mb-3">
                                <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                                    <div class="symbol-label fs-1 text-dark bg-light-info">
                                        <i class="fal fa-sync fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @if($client->savings('active', 'regular')->count())
                                <p class="text-gray-600">{{__('Active Plans')}}</p>
                                @endif
                                @forelse($client->savings('active', 'regular')->get() as $regular)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest"><i class="fal fa-layer-group"></i></span>
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$regular->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($regular->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('admin.save.manage', ['plan' => $regular->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-600 text-center">{{__('No Active Plans')}}</p>
                                @endforelse
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @if($client->savings('expired', 'regular')->count())
                                <p class="text-gray-600">{{__('Expired Plans')}}</p>
                                @endif
                                @foreach($client->savings('expired', 'regular')->get() as $regular)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest"><i class="fal fa-layer-group"></i></span>
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$regular->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($regular->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('admin.save.manage', ['plan' => $regular->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($set->ess || $client->savings('all', 'emergency')->count())
                <div class="col-md-12 mb-6">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_emergency_button">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-bell-on fa-2x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-4 mt-4 d-block">{{__('Emergency Savings')}}</p>
                        <p class="fs-1 fw-bolder text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($client->savings('active', 'emergency')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Active plans: ').$client->savings('all', 'emergency')->count()}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Total Saved: ').$currency->currency_symbol.currencyFormat(number_format($client->totalSavings('emergency')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Returns: ').$currency->currency_symbol.currencyFormat(number_format($client->totalSavingsReturn('emergency')->sum('amount'), 2)).' '.$currency->currency}}</p>
                    </div>
                </div>
                <div id="kt_emergency_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_emergency_button" data-kt-drawer-close="#kt_emergency_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Emergency Savings')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_emergency_close">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fal fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-wrap">
                            <div class="btn-wrapper text-center mb-3">
                                <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                                    <div class="symbol-label fs-1 text-dark bg-light-info">
                                        <i class="fal fa-bell-on fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @forelse($client->savings('active', 'emergency')->get() as $emergency)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest"><i class="fal fa-layer-group"></i></span>
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$emergency->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($emergency->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('admin.save.manage', ['plan' => $emergency->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-600 text-center">{{__('No Active Plans')}}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($set->dss || $client->savings('all', 'duo')->count())
                <div class="col-md-12 mb-6">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7 h-100 cursor-pointer" id="kt_duo_button">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-50px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-heart-circle-check fa-2x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-4 mt-4 d-block">{{__('Duo Savings')}}</p>
                        <p class="fs-1 fw-bolder text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($client->savings('all', 'duo')->sum('amount'), 2)).' '.$currency->currency}}</p>
                        <p class="fs-6 text-gray-800 mb-0">{{__('Active Plans: ').$client->savings('all', 'duo')->count()}}</p>
                    </div>
                </div>
                <div id="kt_duo_money" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_duo_button" data-kt-drawer-close="#kt_duo_close" data-kt-drawer-width="{'md': '500px'}">
                    <div class="card w-100">
                        <div class="card-header pe-5 border-0">
                            <div class="card-title">
                                <div class="d-flex justify-content-center flex-column me-3">
                                    <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Duo Savings')}}</div>
                                </div>
                            </div>
                            <div class="card-toolbar">
                                <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_duo_close">
                                    <span class="svg-icon svg-icon-2">
                                        <i class="fal fa-times"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-wrap">
                            <div class="btn-wrapper text-center mb-3">
                                <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                                    <div class="symbol-label fs-1 text-dark bg-light-info">
                                        <i class="fal fa-heart-circle-check fa-2x text-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pb-5 mt-10 position-relative zindex-1">
                                @forelse($client->savings('all', 'duo')->get() as $duo)
                                <div class="d-flex flex-stack mb-6 bg-light p-3 rounded-3">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip">
                                            @if($duo->user_id == $client->id)
                                            @if($duo->partner->avatar == null)
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($duo->partner->business->name), 0, 1)}}</span>
                                            @else
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$duo->partner->avatar}})"></div>
                                            @endif
                                            @else
                                            @if($duo->user->avatar == null)
                                            <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($duo->user->business->name), 0, 1)}}</span>
                                            @else
                                            <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$duo->user->avatar}})"></div>
                                            @endif
                                            @endif
                                        </div>
                                        <div class="ps-2">
                                            <p class="fs-6 text-dark fw-bolder mb-0">{{$duo->name}}</p>
                                            <p class="fs-6 text-info mb-0">{{$currency->currency_symbol.currencyFormat(number_format($duo->amount, 2)).' '.$currency->currency}}</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <a href="{{route('admin.save.manage', ['plan' => $duo->id])}}" class="btn btn-sm btn-light-info me-3"><i class="fal fa-check-circle"></i> {{__('Manage')}}</a>
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-600 text-center">{{__('No Active Plans')}}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>