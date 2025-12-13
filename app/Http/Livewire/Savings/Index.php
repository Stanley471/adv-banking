<?php

namespace App\Http\Livewire\Savings;

use Livewire\Component;
use App\Models\Category;
use App\Models\Savings;
use App\Models\Transactions;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Jobs\CustomEmail;
use App\Jobs\SendEmail;

class Index extends Component
{
    public $user;
    public $settings;
    public $interest;
    public $plan;
    public $regular_amount;
    public $regular_name;
    public $regular_plan;
    public $regular_automation;
    public $emergency_amount;
    public $emergency_goal;
    public $duo_goal;
    public $duo_name;
    public $merchantId;
    public $emergency_name;
    public $emergency_automation;
    public $emergency_month;

    protected $listeners = ['saved' => '$refresh'];

    public function mount()
    {
        $this->regular_automation = 1;
        $this->emergency_automation = 1;
        $this->emergency_month = '01';
        $this->regular_plan = Category::whereType('regular')->first()->id;
    }

    public function duo()
    {
        if ($this->user->business->kyc_status != 'APPROVED') {
            return $this->emit('alert', __('Complete compliance'));
        }
        $this->duo_goal = removeCommas($this->duo_goal);

        $this->validate([
            'duo_goal' => ['required', 'numeric'],
            'duo_name' => ['required', 'string', 'max:255'],
            'merchantId' => ['required', 'string', 'min:6', 'max:6'],
        ]);

        if ($this->merchantId == $this->user->merchant_id) {
            return $this->addError('merchant_id', __('You can\'t add your self to a duo savings plan'));
        }

        if (Savings::whereUserId($this->user->id)->whereName($this->regular_name)->whereType('duo')->exists()) {
            return $this->addError('duo_name', 'Plan with thesame name already exists');
        }

        $ben = User::whereMerchantId($this->merchantId)->first();

        $save = Savings::create([
            'user_id' => $this->user->id,
            'ref_id' => Str::uuid(),
            'name' => $this->duo_name,
            'type' => 'duo',
            'goal' => $this->duo_goal,
            'interest' => $this->settings->dsi,
            'expiry_date' => Carbon::now()->addMonths(12)->toDateString(),
            'resend_time' => Carbon::now()->addHours(1),
            'partner_id' => $ben->id,
        ]);

        createAudit('Created saving plan' . $save->ref_id);

        dispatch(new SendEmail($ben->email, $ben->business->name, 'Join Duo Saving Plan', $this->user->business->name . ' has invited you to join a duo saving plan, click the link below to join saving plan.<br><a href=' . route('duo.plan', ['plan' => $save->ref_id]) . '>' . route('duo.plan', ['plan' => $save->ref_id]) . '</a>', null, null, 0));

        return redirect()->route('user.followed', ['type' => 'savings'])->with('success', __('Saving Plan created'));
    }

    public function emergency()
    {
        if ($this->user->business->kyc_status != 'APPROVED') {
            return $this->emit('alert', __('Complete compliance'));
        }
        $this->emergency_amount = removeCommas($this->emergency_amount);
        $this->emergency_goal = removeCommas($this->emergency_goal);
        $balance = $this->user->getFirstBalance();
        $this->validate([
            'emergency_amount' => ['required', 'numeric', 'min:' . $this->settings->min_ega, 'lte:emergency_goal'],
            'emergency_goal' => ['required', 'numeric', 'gte:emergency_amount'],
            'emergency_automation' => ['required'],
            'emergency_month' => ['required'],
            'emergency_name' => ['required', 'string', 'max:255'],
        ], [
            'emergency_goal.gte' => 'Goal must be greater than starting amount'
        ]);

        if ($this->emergency_automation == 1) {
            if ($this->user->getFirstBalance()->amount < $this->emergency_amount) {
                return $this->addError('emergency_amount', __('Insufficient Balance'));
            } else {
                $balance->update(['amount' => $balance->amount - $this->emergency_amount]);
            }
        }

        if (Savings::whereUserId($this->user->id)->whereName($this->regular_name)->whereType('emergency')->exists()) {
            return $this->addError('emergency_name', 'Plan with thesame name already exists');
        }

        $save = Savings::create([
            'user_id' => $this->user->id,
            'ref_id' => Str::uuid(),
            'name' => $this->emergency_name,
            'type' => 'emergency',
            'goal' => $this->emergency_goal,
            'amount' => $this->emergency_amount,
            'interest' => $this->settings->egi,
            'expiry_date' => Carbon::now()->addMonths(12)->toDateString(),
            'reminder_month' => Carbon::create($this->emergency_month . '-' . Carbon::now()->addMonth(1)->format('m') . '-' . date('Y')),
            'day' => $this->emergency_month,
        ]);

        createAudit('Created saving plan' . $save->ref_id);

        if ($this->emergency_automation == 1) {
            $trx = Transactions::create([
                'user_id' => $this->user->id,
                'save_id' => $save->id,
                'business_id' => $this->user->business_id,
                'amount' => $this->emergency_amount,
                'ref_id' => Str::uuid(),
                'trx_type' => 'debit',
                'type' => 'savings_deposit',
                'status' => 'success',
            ]);
            dispatch(new CustomEmail('savings_deposit', $trx->id));
        }
        return redirect()->route('user.followed', ['type' => 'savings'])->with('success', __('Saving Plan created'));
    }

    public function regular()
    {
        if ($this->user->business->kyc_status != 'APPROVED') {
            return $this->emit('alert', __('Complete compliance'));
        }
        $this->regular_amount = removeCommas($this->regular_amount);
        $balance = $this->user->getFirstBalance();
        $this->validate([
            'regular_amount' => ['required', 'numeric', 'min:' . $this->settings->min_rga],
            'regular_plan' => ['required'],
            'regular_automation' => ['required'],
            'regular_name' => ['required', 'string', 'max:255'],
        ]);

        if ($this->regular_automation == 1) {
            if ($this->user->getFirstBalance()->amount < $this->regular_amount) {
                return $this->addError('regular_amount', __('Insufficient Balance'));
            } else {
                $balance->update(['amount' => $balance->amount - $this->regular_amount]);
            }
        }

        if (Savings::whereUserId($this->user->id)->whereName($this->regular_name)->whereType('regular')->exists()) {
            return $this->addError('regular_name', 'Plan with thesame name already exists');
        }

        $planDetails = Category::find($this->regular_plan);

        $save = Savings::create([
            'user_id' => $this->user->id,
            'plan_id' => $planDetails->id,
            'ref_id' => Str::uuid(),
            'name' => $this->regular_name,
            'type' => 'regular',
            'amount' => ($this->regular_automation == 1) ? $this->regular_amount : 0,
            'interest' => $planDetails->interest,
            'expiry_date' => Carbon::now()->addMonths($planDetails->duration)->toDateString(),
        ]);

        createAudit('Created saving plan' . $save->ref_id);

        if ($this->regular_automation == 1) {
            $trx = Transactions::create([
                'user_id' => $this->user->id,
                'save_id' => $save->id,
                'business_id' => $this->user->business_id,
                'amount' => $this->regular_amount,
                'ref_id' => Str::uuid(),
                'trx_type' => 'debit',
                'type' => 'savings_deposit',
                'status' => 'success',
            ]);
            dispatch(new CustomEmail('savings_deposit', $trx->id));
        }
        return redirect()->route('user.followed', ['type' => 'savings'])->with('success', __('Saving Plan created'));
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

    public function render()
    {
        return view('livewire.savings.index');
    }
}
