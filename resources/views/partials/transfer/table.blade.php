@foreach($transactions as $k=>$val)
<tr class="cursor-pointer" onclick="window.location='{{route('transaction.receipt', $val->id)}}'" style="transition: background 0.2s;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='transparent'">
    <td>
        <div class="symbol symbol-40px symbol-circle me-5">
            <div class="symbol-label fs-3 fw-bolder text-info bg-light-info">
                @if($val->trx_type == 'debit')
                <i class="fal fa-minus"></i>
                @else
                <i class="fal fa-plus"></i>
                @endif
            </div>
        </div>
    </td>
    <td>{{$currency->currency_symbol.currencyFormat(number_format($val->amount, 2)).' '.$currency->currency}}</td>
    <td>{{ucwords(str_replace('_', ' ', $val->type))}}</td>
    <td>
        @if($val->status == 'success')
        <span class="badge badge-pill badge-success badge-sm">{{__('Success')}}</span>
        @elseif($val->status == 'pending')
        <span class="badge badge-pill badge-info badge-sm">{{__('Pending')}}</span>
        @elseif($val->status == 'failed')
        <span class="badge badge-pill badge-danger badge-sm">{{__('Failed')}}</span>
        @elseif($val->status == 'cancelled')
        <span class="badge badge-pill badge-danger badge-sm">{{__('Cancelled')}}</span>
        @endif
    </td>
    @if($all == 1)<td>{{$val->ref_id}}</td> @endif
    <td>{{$val->created_at->toDayDateTimeString()}}</td>
</tr>
@endforeach