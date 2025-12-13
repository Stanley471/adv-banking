<div>
    <div class="row g-xl-8 mb-6">
        <div class="col-md-12">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <div class="input-group input-group-solid mb-5 rounded-4">
                    <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                    <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search circles')}}" />
                </div>
            </div>
        </div>
    </div>
    @if($plans->count() > 0)
    <div class="row">
        @foreach($plans as $val)
        <div class="col-md-3 mb-6" id="kt_join_{{$val->id}}_button">
            <div class="card cursor-pointer rounded-5 mb-3 circle-img h-300px" wire:ignore.self>
                <div class="card-body pt-9 pb-0">
                    <div class="row mb-10">
                        <div class="col-md-12 text-end mb-20">
                            <p class="text-dark fs-4 fw-boldest me-3 mb-0"><i class="fal fa-users"></i> {{$val->savings->count()}}</p>
                        </div>
                        <div class="col-md-12 text-end">
                            <div class="symbol symbol-100px me-7 mb-4 symbol-circle bottom-left">
                                <span class="symbol-label bg-transparent" style="background-image:url({{url('/').'/storage/app/'.$val->image}}); background-size: auto 100%;"></span>
                            </div>
                            <img src="{{url('/').'/storage/app/'.$val->image}}" style="display:none;" class="card-image bottom-left">
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-dark fs-4 fw-bolder">{{$val->name}}</p>
        </div>
        @endforeach
        @if($plans->total() > 0 && $plans->count() < $plans->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
            @else
            <div class="text-center mt-20">
                <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                <h3 class="text-dark">{{__('No Circle Found')}}</h3>
            </div>
            @endif
    </div>
    @foreach($plans as $val)
    <livewire:savings.join-circle :val=$val :user=$user :settings=$set :wire:key="'kt_join_'. $val->id">
        @endforeach
</div>
@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {

        function fetchColor() {
            const colorThief = new ColorThief();
            $('.circle-img').each(function(index, card) {
                const cardImage = $(card).find('img.card-image')[0];
                const dominantColor = colorThief.getColor(cardImage);

                $(card).css('background-color', `rgb(${dominantColor[0]}, ${dominantColor[1]}, ${dominantColor[2]}, 0.1)`);
            });
        }

        $(window).on('load', function() {
            fetchColor()
        });

        window.livewire.on('color', data => {
            fetchColor()
        });
    });
</script>
@endpush