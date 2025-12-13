<?php

namespace App\Http\Livewire\Savings;

use Livewire\Component;
use App\Models\Countrysupported;
use App\Models\Transactions;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Jobs\CustomEmail;
use App\Jobs\SendEmail;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class Manage extends Component
{
    public $user;
    public $settings;
    public $plan;
    public $from;
    public $to;
    public $duration;
    public $add_amount;
    public $withdraw_amount;
    private $recent;
    public $perPage = 100;
    public $sortBy = "created_at";
    public $orderBy = "desc";
    public $search = "";

    protected $listeners = ['saved' => '$refresh'];

    public function getDuration($duration)
    {
        if ($duration == 'monday') {
            return Carbon::MONDAY;
        } else if ($duration == 'tuesday') {
            return Carbon::TUESDAY;
        } else if ($duration == 'wednesday') {
            return Carbon::WEDNESDAY;
        } else if ($duration == 'thursday') {
            return Carbon::THURSDAY;
        } else if ($duration == 'friday') {
            return Carbon::FRIDAY;
        } else if ($duration == 'saturday') {
            return Carbon::SATURDAY;
        } else if ($duration == 'sunday') {
            return Carbon::SUNDAY;
        }
    }

    public function edit()
    {
        if($this->plan->type == 'circle'){
            $this->plan->update([
                'day' => $this->duration,
                'reminder_month' => ($this->plan->duration == 'weekly') ? Carbon::now()->copy()->next($this->getDuration($this->duration)) : Carbon::create($this->plan->duration . '-' . Carbon::now()->addMonth(1)->format('m') . '-' . date('Y')),
            ]);
        }else{
            $this->plan->update([
                'day' => $this->duration,
                'reminder_month' => Carbon::create($this->plan->duration . '-' . Carbon::now()->addMonth(1)->format('m') . '-' . date('Y')),
            ]);
        }
        return redirect()->route('save.manage', ['plan' => $this->plan->id])->with('success', __('Schedule updated'));
    }
    
    public function delete()
    {
        if ($this->plan->amount == 0 || $this->plan->amount == null) {
            $this->plan->delete();
            return redirect()->route('user.followed', ['type' => 'savings'])->with('success', __('Saving plan deleted'));
        } else {
            return $this->emit('alert', __('You can\'t delete a plan that has funds already.'));
        }
    }

    public function add()
    {
        if ($this->user->business->kyc_status != 'APPROVED') {
            return $this->emit('alert', __('Complete compliance'));
        }
        $this->add_amount = removeCommas($this->add_amount);
        $balance = $this->user->getFirstBalance();
        $this->validate([
            'add_amount' => ['required', 'numeric'],
        ]);

        if ($this->plan->expiry_date < Carbon::today() && $this->plan->type == 'regular') {
            return $this->addError('added', __('Plan Expired'));
        }
        if ($this->user->getFirstBalance()->amount < $this->add_amount) {
            return $this->addError('add_amount', __('Insufficient Balance'));
        } else {
            if ($this->plan->type == 'circle') {
                $old = $this->plan->circle->savings->whereNotNull('amount')->first();
                if ($old->amount < ($this->plan->amount + $this->add_amount) && $old->user->id != $this->user->id) {
                    $currency = Countrysupported::find(1)->real;
                    $diff = $currency->currency_symbol . currencyFormat(number_format((($this->plan->amount + $this->add_amount) - $old->amount), 2)) . ' ' . $currency->currency;
                    dispatch(new SendEmail($old->user->email, $old->user->business->name, 'New Top Saver', 'Hey ' . $old->user->business->name . ', this is just a friendly reminder that you are no longer the top saver for <b>' . $this->plan->circle->name . '</b>, you have been surpassed by ' . $this->user->business->name . ' with ' . $diff, null, null, 0));
                    dispatch(new SendEmail($this->user->email, $this->user->business->name, 'Lonely at the Top', 'Hey ' . $this->user->business->name . ', this is just a friendly reminder that you are now the top saver for <b>' . $this->plan->circle->name . '</b>, you just surpassed ' . $old->user->business->name . ' with ' . $diff . ' congrats!', null, null, 0));
                }
            }
            $balance->update(['amount' => $balance->amount - $this->add_amount]);
            $this->plan->update(['amount' => $this->plan->amount + $this->add_amount]);
        }

        createAudit('Topped up saving plan' . $this->plan->ref_id);



        $trx = Transactions::create([
            'user_id' => $this->user->id,
            'save_id' => $this->plan->id,
            'business_id' => $this->user->business_id,
            'amount' => $this->add_amount,
            'ref_id' => Str::uuid(),
            'trx_type' => 'debit',
            'type' => 'savings_deposit',
            'status' => 'success',
        ]);
        dispatch(new CustomEmail('savings_deposit', $trx->id));
        $this->reset(['add_amount']);
        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', 'Savings topped up!');
    }

    public function withdraw()
    {
        if ($this->user->business->kyc_status != 'APPROVED') {
            return $this->emit('alert', __('Complete compliance'));
        }
        $this->withdraw_amount = removeCommas($this->withdraw_amount);
        $balance = $this->user->getFirstBalance();

        $this->validate([
            'withdraw_amount' => ['required', 'numeric'],
        ]);

        if ($this->plan->amount < $this->withdraw_amount) {
            return $this->addError('withdraw_amount', __('Insufficient Balance'));
        }

        if ($this->plan->type == 'regular') {
            return $this->addError('withdraw_amount', __('You can\'t withdraw from regular plans'));
        }

        $balance->update(['amount' => $balance->amount + $this->withdraw_amount]);
        $this->plan->update(['amount' => $this->plan->amount - $this->withdraw_amount]);

        createAudit('Withdraw from saving plan' . $this->plan->ref_id);

        $trx = Transactions::create([
            'user_id' => $this->user->id,
            'save_id' => $this->plan->id,
            'business_id' => $this->user->business_id,
            'amount' => $this->withdraw_amount,
            'ref_id' => Str::uuid(),
            'trx_type' => 'credit',
            'type' => 'savings_withdraw',
            'status' => 'success',
        ]);
        dispatch(new CustomEmail('savings_withdraw', $trx->id));
        $this->reset(['withdraw_amount']);
        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', 'Savings withdrawn!');
    }

    public function mount()
    {
        if ($this->plan->type == 'emergency' || $this->plan->type == 'duo') {
            $this->from = $this->plan->expiry_date->subYear(1)->format('M j, Y');
            $this->to = $this->plan->expiry_date->format('M j, Y');
        }
        if($this->plan->type == 'circle' || $this->plan->type == 'emergency'){
            $this->duration = $this->plan->day;
        }
    }

    public function xBalance()
    {
        $business = $this->user->business;
        if ($business->reveal_balance == 1) {
            $business->update(['reveal_balance' => 0]);
        } else {
            $business->update(['reveal_balance' => 1]);
        }
    }

    public function loadMore()
    {
        $this->perPage = $this->perPage + 10;
        $this->emit('drawer');
    }

    public function render()
    {
        $trx = Transactions::whereSaveId($this->plan->id)->with(['user', 'business'])
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->where('amount', 'like', '%' . $this->search . '%')
                        ->orWhere('charge', 'like', '%' . $this->search . '%')
                        ->orWhere('ref_id', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'first_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->sortBy, $this->orderBy)->get();

        $this->recent = $trx->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $paginatedGroups = new LengthAwarePaginator(
            $this->recent->forPage(request('page'), $this->perPage), // Groups for the current page
            $this->recent->count(), // Total number of groups
            $this->perPage, // Groups per page
            Paginator::resolveCurrentPage(), // Current page number
            ['path' => Paginator::resolveCurrentPath()] // Additional options
        );

        $first = ($this->plan->type == 'circle') ? $this->plan->circle->savings->whereNotNull('amount')->first() : null;

        return view('livewire.savings.manage', ['transactions' => $trx, 'group' => $paginatedGroups, 'first' => $first]);
    }
}
