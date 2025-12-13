<div>
    <div class="d-flex justify-content-between flex-wrap align-items-center" id="kt-image-{{$val->id}}">
        <!--begin::Users-->
        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="">
            <img src="{{url('/').'/storage/app/'.$val->image}}">
        </div>
        <!--end::Users-->
        <!--begin::Stats-->
        <div class="d-flex">
            <a wire:click="delete" class="btn btn-sm btn-secondary">Delete</a>
        </div>
        <!--end::Stats-->
    </div>
</div>