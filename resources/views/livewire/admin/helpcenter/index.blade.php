<div>
    <div class="toolbar" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Help Center')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{__('Help Center')}}</li>
                </ul>
            </div>
            <div class="d-flex align-items-center flex-nowrap text-nowrap py-1">
                <button id="kt_article_button" class="btn btn-white text-dark me-4"><i class="fal fa-plus"></i> {{__('Add an Article')}}</button>
                <button id="kt_category_button" class="btn btn-dark me-4"><i class="fal fa-plus"></i> {{__('Category')}}</button>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_category" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_category_button" data-kt-drawer-close="#kt_category_close" data-kt-drawer-width="{'md': '500px'}">
        <div class="card w-100">
            <div class="card-header pe-5 border-0">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1">{{__('Create a Topic')}}</div>
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-icon-dark btn-active-light-primary" data-kt-drawer-dismiss="true" id="kt_category_close">
                        <span class="svg-icon svg-icon-2">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body text-wrap">
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        <div class="symbol-label fs-1 text-dark">
                            <i class="fal fa-layer-group fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="addCategory" method="post">
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="cat_name" required placeholder="Name of category" />
                            @error('cat_name')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <textarea class="form-control form-control-lg form-control-solid" rows="4" type="text" wire:model.defer="cat_description" required placeholder="Description"></textarea>
                            @error('cat_description')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <div class="input-group mb-3">
                                <span class="input-group-text border-0">fal fa-</span>
                                <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="cat_icon" required placeholder="icon name" />
                            </div>
                            <span class="form-text"><a href="https://fontawesome.com" target="_blank">https://fontawesome.com</a></span>
                            @error('cat_icon')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="addCategory">{{__('Create Topic')}}</span>
                                <span wire:loading wire:target="addCategory">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self id="kt_article" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#kt_article_button" data-kt-drawer-close="#kt_article_close" data-kt-drawer-width="{'md': '700px'}">
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
                <div class="btn-wrapper text-center mb-3">
                    <div class="symbol symbol-100px symbol-circle me-5 mb-10">
                        <div class="symbol-label fs-1 text-dark">
                            <i class="fal fa-newspaper fa-2x"></i>
                        </div>
                    </div>
                </div>
                <div class="pb-5 mt-10 position-relative zindex-1">
                    <form class="form w-100 mb-10" wire:submit.prevent="addArticle" method="post">
                        <div class="fv-row mb-6">
                            <select class="form-select form-select-solid" wire:model.defer="category">
                                <option value="">Select Category</option>
                                @foreach($topics as $val)
                                <option value="{{$val->id}}">{{$val->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <input class="form-control form-control-lg form-control-solid" type="text" wire:model.defer="question" required placeholder="Question" />
                            @error('question')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="fv-row mb-6">
                            <textarea class="form-control form-control-lg form-control-solid preserveLines" rows="10" type="text" wire:model.defer="answer" required placeholder="Answer"></textarea>
                            @error('answer')
                            <span class="form-text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="text-center mt-10">
                            <button type="submit" class="btn btn-lg btn-info btn-block fw-bolder me-3 my-2">
                                <span wire:loading.remove wire:target="addArticle">{{__('Submit Article')}}</span>
                                <span wire:loading wire:target="addArticle">{{__('Processing Request...')}}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-lg-12 col-md-12">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <div class="col-md-12">
                            <div class="input-group input-group-solid mb-5 rounded-4">
                                <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                                <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search Topic')}}" />
                            </div>
                        </div>
                    </div>
                    @if($topics->count() > 0)
                    <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5">
                        <thead>
                            <tr class="fw-semibold fs-6 text-muted">
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Articles</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th class="scope"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topics as $val)
                            <tr>
                                <td>{{$loop->iteration}}.</td>
                                <td>{{$val->name}}</td>
                                <td>{{$val->faq->count()}}</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                                <td>{{date("Y/m/d h:i:A", strtotime($val->updated_at))}}</td>
                                <td class="text-center">
                                    <a href="{{route('topic.articles', ['topic' => $val->id])}}" class="btn btn-sm btn-secondary">Articles</a>
                                    <button id="kt_category_{{$val->id}}_button" class="btn btn-sm btn-light-info">Edit</button>
                                    <a data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($topics->total() > 0 && $topics->count() < $topics->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
                    @else
                    <div class="text-center mt-20">
                        <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                        <h3 class="text-dark">{{__('No Topic Found')}}</h3>
                        <p class="text-dark">{{__('We couldn\'t find any topic on helpcenter, click add category')}}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @foreach($topics as $val)
    <livewire:admin.helpcenter.edit-category :val=$val :wire:key="'kt_category_'. $val->id">
        @endforeach
</div>