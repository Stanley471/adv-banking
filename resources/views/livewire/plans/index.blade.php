<div>
    <div class="px-9 pt-6 rounded h-250px w-100 castro-secret2 bgi-no-repeat bgi-size-cover bgi-position-y-top rounded-5">
        <div class="d-flex flex-stack mt-6">
            <h3 class="m-0 text-white fw-bolder fs-3">{{__('Invest Funds')}}</h3>
        </div>
        <div class="d-flex align-items-center align-self-center flex-wrap pt-6">
            <div class="fw-bold fs-5 text-start text-white pt-5">
                <span class="fi fi-{{strtolower($currency->iso2)}} mr-2 fis fs-1 rounded-4 text-white"></span> {{__('Total Investment')}}
                <span class="fw-bolder fs-2hx d-block mt-n1 text-white">
                    <span id="main_balance">
                        @if($user->business->reveal_balance == 1){{$currency->currency_symbol.currencyFormat(number_format($user->followed()->sum('amount') - $user->followed()->sum('sold'), 2)).' '.$currency->currency}} @else ************ @endif
                    </span>
                    <span class="ml-3 fs-3 cursor-pointer" wire:click="xBalance">
                        <i class="fal fa-eye-slash" id="hide_balance" @if($user->business->reveal_balance == 0) style="display:none;" @endif></i>
                        <i class="fal fa-eye" id="reveal_balance" @if($user->business->reveal_balance == 1) style="display:none;" @endif></i>
                    </span>
                </span>
            </div>
        </div>
    </div>
    <div class="mx-md-6 mx-4 mt-n20">
        <!--begin::Row-->
        <div class="row g-8 row-cols-1 row-cols-sm-2">
            <!--begin::Col-->
            @if(getPlans('mutual')->count())
            <div class="col mb-3">
                <a href="{{route('user.mutual', ['type' => 'recommended'])}}">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-75px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-globe fa-3x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-3 mt-4 d-block">{{__('Mutual Funds')}}</p>
                        <p class="text-dark">{{__('Own a mix of stocks, bonds, treasury bills and other financial instruments. All on your terms.')}}</p>
                    </div>
                </a>
            </div>
            @endif
            @if(getPlans('project')->count())
            <div class="col mb-3">
                <a href="{{route('user.project', ['type' => 'active'])}}">
                    <div class="text-start bg-white shadow-xs rounded-5 p-7">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-75px mt-1 mb-3">
                            <span class="symbol-label bg-light-info rounded-4">
                                <i class="fal fa-rectangle-vertical-history fa-3x text-info"></i>
                            </span>
                        </div>
                        <!--end::Symbol-->
                        <p class="text-dark fw-boldest fs-3 mt-4 d-block">{{__('Projects')}}</p>
                        <p class="text-dark">{{__('Earn money from Real estate, IT, Livestocks, Transportation projects, Health, Crop projects.')}}</p>
                    </div>
                </a>
            </div>
            @endif
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
</div>