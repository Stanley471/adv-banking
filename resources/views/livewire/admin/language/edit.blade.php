<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Edit Translation')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.language')}}" class="text-muted text-hover-primary">{{__('Languages')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{__('Edit')}}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form wire:submit.prevent="update(Object.fromEntries(new FormData($event.target)))" method="post">
                                <div class="text-right mb-5">
                                    <button type="submit" wire:target="update" class="btn btn-info btn-sm">{{__('Save')}}</button>
                                </div>
                                @csrf
                                @foreach (json_decode(file_get_contents(resource_path('lang/'.strtolower($lang->code).'.json')), true) as $key => $value)
                                <div class="fv-row mb-6 row">
                                    <label class="col-form-label col-lg-4">{{$key}}</label>
                                    <div class="col-lg-8">
                                        <input type="text" name="{{$key}}" class="form-control form-control-lg form-control-solid" value="{{$value}}" required>
                                    </div>
                                </div>
                                @endforeach
                                <div class="text-end mt-10">
                                    <button type="submit" class="btn btn-lg btn-info fw-bolder me-3 my-2">
                                        <span wire:loading.remove wire:target="update">{{__('Update Translation')}}</span>
                                        <span wire:loading wire:target="update">{{__('Processing Request...')}}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@push('scripts')
<script>
    window.livewire.on('closeDrawer', function() {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('drawer', data => {
        KTDrawer.hideAll();
        KTDrawer.createInstances();
    });
    window.livewire.on('closeModal', function(data) {
        var myModal = $(`#delete${data}`);
        myModal.modal('hide');
    });
</script>
@endpush