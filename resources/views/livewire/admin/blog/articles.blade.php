<div>
    <div wire:ignore.self class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">{{__('Filter Messages')}}</h3>
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <i class="fal fa-times"></i>
                        </span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="fv-row mb-6">
                        <label class="form-label fs-5 fw-bolder text-dark">{{__('Category')}}</label>
                        <select class="form-select form-select-solid" wire:model="category" required>
                            <option value="">Select Category</option>
                            @foreach($categoryAll as $val)
                            <option value="{{$val->id}}">{{$val->name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="form-text text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Sort by')}}</label>
                        <select class="form-select form-select-solid" wire:model="sortBy">
                            <option value="asc">{{__('ASC')}}</option>
                            <option value="desc">{{__('DESC')}}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Order by')}}</label>
                        <select class="form-select form-select-solid" wire:model="orderBy">
                            <option value="created_at">{{__('Date')}}</option>
                        </select>
                    </div>
                    <div class="fv-row mb-6">
                        <label class="form-label fs-6 fw-bolder text-dark">{{__('Per page')}}</label>
                        <select class="form-select form-select-solid" wire:model="perPage">
                            <option value="10">{{__('10')}}</option>
                            <option value="25">{{__('25')}}</option>
                            <option value="50">{{__('50')}}</option>
                            <option value="100">{{__('100')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="post fs-6 d-flex flex-column-fluid min-vh-100" id="kt_post">
        <div class="container">
            <div class="row g-xl-8">
                <div class="col-md-8">
                    <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                        <div class="input-group input-group-solid mb-5 rounded-4">
                            <span class="input-group-text" id="basic-addon1"><i class="fal fa-search"></i></span>
                            <input type="search" class="form-control form-control-solid text-dark" wire:model="search" placeholder="{{__('Search articles')}}" />
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <button data-bs-toggle="modal" data-bs-target="#filter" class="btn btn-dark me-4"><i class="fal fa-filter-list"></i> {{__('Filter')}}</button>
                </div>
            </div>
            @if($articles->count() > 0)
            <div class="table-responsive">
                <table id="kt_datatable_zero_configuration" class="table table-row-bordered gy-5" wire:loading.class.delay="opacity-50" wire:target="search, status, sortBy, orderBy, perPage, loadMore">
                    <thead>
                        <tr class="fw-semibold fs-6 text-muted">
                            <th class="min-w-20px">{{__('S/N')}}</th>
                            <th class="min-w-250px">{{__('Title')}}</th>
                            <th class="min-w-100px">{{__('Category')}}</th>
                            <th class="min-w-50px">{{__('Views')}}</th>
                            <th class="min-w-150px">{{__('Created')}}</th>
                            <th class="scope"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $val)
                        <tr>
                            <td>{{$loop->iteration}}.</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px">
                                        <span class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$val->image}});"></span>
                                    </div>
                                    <div class="ms-5">
                                        {{substr($val->title, 0, 30)}}... <i class="fal fa-clone castro-copy fs-5" data-clipboard-text="{{route('blog.article', ['article' => $val->slug])}}" title="Copy"></i>
                                    </div>
                                </div>
                            </td>
                            <td>{{$val->category->name}}</td>
                            <td>{{$val->views}}</td>
                            <td>{{date("Y/m/d h:i:A", strtotime($val->created_at))}}</td>
                            <td class="text-center">
                                <button id="kt_edit_{{$val->id}}_button" class="btn btn-sm btn-light-info">Edit</button>
                                <a href="{{route('blog.article', ['article' => $val->slug])}}" target="_blank" class="btn btn-sm btn-secondary">Preview</a>
                                <a data-bs-toggle="modal" data-bs-target="#delete{{$val->id}}" href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if($articles->total() > 0 && $articles->count() < $articles->total())<button wire:click="loadMore" wire:loading.remove class="btn btn-secondary btn-block">{{__('See more')}}</button>@endif
            </div>
            @else
            <div class="text-center mt-20">
                <img src="{{asset('asset/images/beneficiary.png')}}" style="height:auto; max-width:250px;" class="mb-6">
                <h3 class="text-dark">{{__('No Article Found')}}</h3>
                <p class="text-dark">{{__('We couldn\'t find any article')}}</p>
            </div>
            @endif
        </div>
    </div>
    @foreach($articles as $val)
    <livewire:admin.blog.edit-article :val=$val :admin=$admin :wire:key="'kt_edit_'. $val->id">
        @endforeach
</div>