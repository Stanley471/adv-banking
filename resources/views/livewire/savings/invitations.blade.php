<div>
    @if($user->pendingSentDuo->count())
    <hr class="bg-secondary">
    <p class="text-gray-600">{{__('Sent Invitation')}}</p>
    @endif
    @foreach($user->pendingSentDuo as $sent)
    <div class="d-flex flex-stack">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$sent->partner->business->name}}">
                @if($sent->partner->avatar == null)
                <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($sent->partner->business->name), 0, 1)}}</span>
                @else
                <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$sent->partner->avatar}})"></div>
                @endif
            </div>
            <div class="ps-1">
                <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0">{{$sent->partner->business->name}}</p>
                <p class="fs-6 text-gray-800 text-hover-primary mb-0">{{$sent->name}}</p>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a wire:click="resend('{{$sent->id}}')" class="btn btn-sm btn-secondary me-3">
                <span wire:loading.remove wire:target="resend">{{__('Resend invitation')}}</span>
                <span wire:loading wire:target="resend">{{__('Sending invitation...')}}</span>
            </a>
            <a wire:click="cancel('{{$sent->id}}')" class="btn btn-sm btn-danger">{{__('Cancel')}}</a>
        </div>
    </div>
    @endforeach
    @if($user->pendingReceivedDuo->count())
    <hr class="bg-secondary">
    <p class="text-gray-600">{{__('Received Invitation')}}</p>
    @endif
    @foreach($user->pendingReceivedDuo as $received)
    <div class="d-flex flex-stack">
        <div class="d-flex align-items-center">
            <div class="symbol symbol-40px symbol-circle" data-bs-toggle="tooltip" title="" data-bs-original-title="{{$received->user->business->name}}">
                @if($received->user->avatar == null)
                <span class="symbol-label bg-info text-inverse-info fw-boldest">{{substr(ucwords($received->user->business->name), 0, 1)}}</span>
                @else
                <div class="symbol-label" style="background-image:url({{url('/').'/storage/app/'.$received->user->avatar}})"></div>
                @endif
            </div>
            <div class="ps-1">
                <p class="fs-6 text-dark text-hover-primary fw-bolder mb-0">{{$received->user->business->name}}</p>
                <p class="fs-6 text-gray-800 text-hover-primary mb-0">{{$received->name}}</p>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <a wire:click="accept('{{$received->id}}')" class="btn btn-sm btn-secondary me-3"><i class="fal fa-check-circle"></i> {{__('Accept Invitation')}}</a>
            <a wire:click="decline('{{$received->id}}')" class="btn btn-sm btn-danger">{{__('Decline')}}</a>
        </div>
    </div>
    @endforeach
</div>
@push('scripts')
<script>
    window.livewire.on('closeModal', data => {
        $('#delete' + data).modal('hide');
    });
</script>
@endpush