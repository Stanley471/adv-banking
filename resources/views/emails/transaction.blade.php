@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['website' => $website, 'url' => $url, 'logo' => $logo])
@endcomponent
@endslot

{{-- Body --}}
@component('mail::subcopy')
{!! $content !!}
@endcomponent

{{-- Table --}}
@component('mail::table')
<tr style="padding: 2em 0 2em 0;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td valign="middle" width="30%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Amount</span>
            </td>
            <td valign="middle" width="70%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">{!!currencyFormat(number_format($transaction->amount, 2)).' '.$currency->currency!!}</span>
            </td>
        </tr>
        <tr>
            <td valign="middle" width="30%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Fee</span>
            </td>
            <td valign="middle" width="70%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">{!!currencyFormat(number_format($transaction->charge, 2)).' '.$currency->currency!!}</span>
            </td>
        </tr>
        <tr>
            <td valign="middle" width="30%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Type</span>
            </td>
            <td valign="middle" width="70%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">{!!ucwords(str_replace('_', ' ', $transaction->type))!!}</span>
            </td>
        </tr>
        <tr>
            <td valign="middle" width="30%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Reference</span>
            </td>
            <td valign="middle" width="70%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">{!!ucwords($transaction->ref_id)!!}</span>
            </td>
        </tr>
        @if($transaction->type == 'deposit')
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Method</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">{!!$transaction->gateway->name!!}</span>
            </td>
        </tr>
        @endif
        @if($transaction->type == 'payout')
        @if($transaction->acct_id != null)
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Bank</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;"> {!!$transaction->acct->bank->title!!}</span>
            </td>
        </tr>
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Account Number</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">******* {!!substr($transaction->acct->acct_no, -4)!!}</span>
            </td>
        </tr>
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Account Name</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">{!!$transaction->acct->acct_name!!}</span>
            </td>
        </tr>
        @else
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Payout Method</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;"> {!!$transaction->withdrawMethod->name!!}</span>
            </td>
        </tr>
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Details</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">{!!$transaction->details!!}</span>
            </td>
        </tr>
        @endif
        @endif
        @if($transaction->type == 'investment_fee')
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Name</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;"> {!!$transaction->followed->plan->name!!}</span>
            </td>
        </tr>
        @endif
        @if($transaction->type == 'savings_deposit' || $transaction->type == 'savings_withdraw' || $transaction->type == 'savings_return')
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Name</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;"> {!!($transaction->savings->type == 'circle') ? $transaction->savings->circle->name : $transaction->savings->name!!}</span>
            </td>
        </tr>
        @endif
        @if($transaction->type == 'investment_returns')
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Name</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;"> {!!$transaction->followed->plan->name!!}</span>
            </td>
        </tr>
        @endif
        @if($transaction->type == 'debit_transfer')
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Recipient</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;"> {!!$transaction->beneficiary->recipient->business->name!!}</span>
            </td>
        </tr>
        @endif
        @if($transaction->type == 'credit_transfer')
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Sender</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;"> {!!$transaction->sender->business->name!!}</span>
            </td>
        </tr>
        @endif
        @if($transaction->type == 'unit_purchase' || $transaction->type == 'unit_sale' || $transaction->type == 'dividend_return')
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Name</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;"> {!!$transaction->units->plan->name!!}</span>
            </td>
        </tr>
        @if($transaction->type != 'dividend_return')
        <tr>
            <td valign="middle" width="70%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Units</span>
            </td>
            <td valign="middle" width="30%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">{!!$transaction->units->units!!}</span>
            </td>
        </tr>
        @endif
        @endif
        <tr>
            <td valign="middle" width="30%" style="text-align:left; padding: 1em 2.5em;">
                <span style="font-size: 15px;">Date</span>
            </td>
            <td valign="middle" width="70%" style="text-align:right; padding: 1em 2.5em;">
                <span class="price" style="color: #000; font-size: 15px;">{!!$transaction->updated_at->format('d M, Y h:i:A')!!}</span>
            </td>
        </tr>
    </table>
</tr>
@endcomponent

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer', ['website' => $website])
@endcomponent
@endslot
@endcomponent