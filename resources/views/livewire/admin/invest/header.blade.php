<div>
    <div class="toolbar pb-0" id="kt_toolbar">
        <div class="container-fluid d-flex flex-stack flex-wrap flex-sm-nowrap">
            <div class="d-flex flex-column align-items-start justify-content-center flex-wrap me-2">
                <h1 class="text-dark fw-bolder my-1 fs-2">{{__('Invest')}}</h1>
                <ul class="breadcrumb fw-semibold fs-base my-1 mb-6">
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.dashboard')}}" class="text-muted text-hover-primary">{{__('Dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item text-muted">
                        <a href="{{route('admin.invest', ['type' => 'project-plans'])}}" class="text-muted text-hover-primary">{{__('Invest')}}</a>
                    </li>
                    <li class="breadcrumb-item text-dark">{{ucwords(str_replace('-', ' ', $type))}}</li>
                </ul>
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6 border-gray-300" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.invest', ['type' => 'project-plans'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.invest', ['type' => 'project-plans'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Project Plans')}} ({{number_format_short_nc($project_plans)}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.invest', ['type' => 'mutual-plans'])==url()->current()) active @endif" id="tabs-icons-text-1-tab" href="{{route('admin.invest', ['type' => 'mutual-plans'])}}" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">{{__('Mutual Funds Plans')}} ({{number_format_short_nc($mutual_plans)}})</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark @if(route('admin.invest', ['type' => 'category'])==url()->current()) active @endif" id="tabs-icons-text-2-tab" href="{{route('admin.invest', ['type' => 'category'])}}" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">{{__('Category')}} ({{number_format_short_nc($category)}})</a>
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