<div>
    <div class="toolbar pb-0" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Loan & Buy now Pay later')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.loan', ['type' => 'plans'])}}" class="text-muted text-hover-primary">{{__('Loan')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{ucwords(str_replace('-', ' ', $type))}}</li>
                </ul>
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 border-gray-300" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.loan', ['type' => 'loanplans'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.loan', ['type' => 'loanplans'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Loan Plans')}} ({{$loanplans}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.loan', ['type' => 'bnplplans'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.loan', ['type' => 'bnplplans'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Products')}} ({{$bnplplans}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.loan', ['type' => 'pending'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.loan', ['type' => 'pending'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Awaiting approval')}} ({{$pendingApplicants}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.loan', ['type' => 'active'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.loan', ['type' => 'active'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Good & Active')}} ({{$runningApplicants}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.loan', ['type' => 'completed'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.loan', ['type' => 'completed'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Completed')}} ({{$completeApplicants}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.loan', ['type' => 'defaulters'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.loan', ['type' => 'defaulters'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Defaulters')}} ({{$defaultApplicants}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.loan', ['type' => 'category'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.loan', ['type' => 'category'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Product Category')}} ({{$category}})</a>
                    </li>
                </ul>
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
@endpush