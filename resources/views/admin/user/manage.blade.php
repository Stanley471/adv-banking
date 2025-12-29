@extends('admin.menu')

@section('content')
@livewire('admin.users.header', ['type' => $type, 'admin' => $admin, 'client' => $client])
<!-- Block/Unblock User Card -->
<div class="card mb-6">
    <div class="card-header">
        <h3 class="card-title">Account Control</h3>
    </div>
    <div class="card-body">
        <form action="{{route('admin.user.toggle.block', $client->id)}}" method="POST">
            @csrf
            <div class="d-flex align-items-center justify-content-between p-4 rounded" style="background: @if($client->is_blocked) #fee; @else #f0f9ff; @endif">
                <div>
                    <h5 class="mb-2 @if($client->is_blocked) text-danger @else text-dark @endif">
                        @if($client->is_blocked)
                            <i class="fas fa-ban me-2"></i>Account Blocked
                        @else
                            <i class="fas fa-check-circle me-2 text-success"></i>Account Active
                        @endif
                    </h5>
                    <p class="text-muted small mb-0">
                        @if($client->is_blocked)
                            This user cannot make transfers. All transfer attempts will fail.
                        @else
                            User can make transfers normally.
                        @endif
                    </p>
                </div>
                <button type="submit" class="btn btn-lg @if($client->is_blocked) btn-success @else btn-danger @endif">
                    @if($client->is_blocked)
                        <i class="fas fa-unlock me-2"></i>Unblock User
                    @else
                        <i class="fas fa-ban me-2"></i>Block User
                    @endif
                </button>
            </div>
        </form>
    </div>
</div>
@livewire('admin.users.'.$type, ['type' => $type, 'admin' => $admin, 'client' => $client])
@stop
@section('script')
<script>
    $(function() {

        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#range').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('input[id="range"]').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

    });
</script>
@endsection