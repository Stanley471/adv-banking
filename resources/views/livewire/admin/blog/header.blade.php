<div>
    <div class="toolbar pb-0" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Blog')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.blog', ['type' => 'articles'])}}" class="text-muted text-hover-primary">{{__('Blog')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{ucwords($type)}}</li>
                </ul>
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 border-gray-300" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.blog', ['type' => 'articles'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.blog', ['type' => 'articles'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Published')}} ({{number_format_short_nc($articles)}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.blog', ['type' => 'draft'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.blog', ['type' => 'draft'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Draft')}} ({{number_format_short_nc($draft)}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.blog', ['type' => 'category'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.blog', ['type' => 'category'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Category')}} ({{number_format_short_nc($category)}})</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.blog', ['type' => 'deleted'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.blog', ['type' => 'deleted'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Deleted')}} ({{number_format_short_nc($deleted)}})</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                <button id="kt_article_button" class="btn btn-info me-4"><i class="fal fa-newspaper"></i> {{__('Add article')}}</button>
            </div>
            <div wire:ignore.self id="kt_article" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_article_button" data-kt-drawer-close="#kt_article_close" data-kt-drawer-width="{'md': '900px'}">
                <div class="card w-100">
                    <div class="card-header pe-5 border-0">
                        <div class="card-title">
                            <div class="d-flex justify-content-center flex-column me-3">
                                <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Write an Article')}}</div>
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_article_close">
                                <span class="svg-icon svg-icon-2">
                                    <i class="fal fa-times"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body text-wrap">
                        <div class="pb-5 mt-10 position-relative zindex-1">
                            <form class="form w-100 mb-10" wire:submit.prevent="addArticle" method="post">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!--begin::Thumbnail settings-->
                                        <div class="card card-flush py-4">
                                            <!--begin::Card body-->
                                            <div class="card-body text-center pt-0" wire:ignore>
                                                <!--begin::Image input-->
                                                <!--begin::Image input placeholder-->
                                                <style>
                                                    .image-input-placeholder {
                                                        background-image: url({{asset('dashboard/media/svg/files/blank-image.svg')}})
                                                    }
                                                </style>
                                                <!--end::Image input placeholder-->

                                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                                    <!--end::Preview existing avatar-->

                                                    <!--begin::Label-->
                                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                        <i class="bi bi-pencil-fill fs-7"></i>

                                                        <!--begin::Inputs-->
                                                        <input type="file" wire:model="image" id="image" accept=".png, .jpg, .jpeg" required>
                                                        <input type="hidden" name="avatar_remove">
                                                        <!--end::Inputs-->
                                                    </label>
                                                    <!--end::Label-->

                                                    <!--begin::Cancel-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Cancel-->

                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                                <!--end::Image input-->

                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">Set the thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                                                @error('image')
                                                <span class="form-text text-danger">{{$message}}</span>
                                                @enderror
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Category')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="selectCategory" required>
                                                <option value="">Select Category</option>
                                                @foreach($categoryAll as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('selectCategory')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6">
                                            <label class="form-label fs-5 fw-bolder text-dark">{{__('Status')}}</label>
                                            <select class="form-select form-select-solid" wire:model.defer="status" required>
                                                <option value="0">{{__('Draft')}}</option>
                                                <option value="1">{{__('Published')}}</option>
                                            </select>
                                            @error('status')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="fv-row mb-6">
                                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model="title" required placeholder="Title of article" />
                                            @error('title')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="fv-row mb-6" wire:ignore>
                                            <textarea class="form-control form-control-lg form-control-solid tinymce" rows="10" type="text" wire:model.defer="details" placeholder="Type your text"></textarea>
                                            @error('details')
                                            <span class="form-text text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center mt-10">
                                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                                <span wire:loading.remove wire:target="addArticle">{{__('Submit Article')}}</span>
                                                <span wire:loading wire:target="addArticle">{{__('Processing Request...')}}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
</script>
<script>
document.addEventListener('livewire:load', function () {
    tinymce.init({
        selector: 'textarea.tinymce',
        forced_root_block: false,
        setup: function (editor) {
            editor.on('init change', function () {
                editor.save();
            });
            editor.on('change', function (e) {
                @this.set('details', editor.getContent());
            });
        }
    });
});
</script>
@endpush