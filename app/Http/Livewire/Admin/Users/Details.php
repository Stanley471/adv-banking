<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Jobs\CustomEmail;
use App\Jobs\SendEmail;
use App\Models\Admin;
use App\Models\Settings;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Details extends Component
{
    public $client;
    public $reason;
    public $kyc_expiry;
    public $g_expiry;
    public $guarantor_reason;
    public $amount;
    public $password;

    public function mount()
    {
        $this->amount = number_format($this->client->getFirstBalance()->amount, 2);
    }

    public function editBalance()
    {
        $admin = Admin::whereRole('super')->first();
        $set = Settings::find(1);
        $this->amount = removeCommas($this->amount);
        if (Hash::check($this->password, $admin->password)) {
            $balance = $this->client->getFirstBalance();
            if ($this->amount != $balance->amount) {
                if ($this->amount > $balance->amount) {
                    $amount = $this->amount - $balance->amount;
                    $type = 'credit';
                } else {
                    $amount =  $balance->amount - $this->amount;
                    $type = 'debit';
                }
                $balance->update(['amount' => $this->amount]);
                $object = [
                    'user_id' => $this->client->id,
                    'business_id' => $this->client->business_id,
                    'amount' => $amount,
                    'ref_id' => Str::uuid(),
                    'trx_type' => $type,
                    'type' => 'acccount_' . $type . '_by_' . $set->site_name,
                    'status' => 'success',
                ];
                $trx = Transactions::create($object);
                createAudit('acccount_' . $type . '_by_' . $set->site_name . ' ' . $trx->ref_id, $this->client);
                $this->reset(['password']);
                $this->emit('closeDrawer');
                $this->emit('saved');
                $this->emit('success', __('Balance updated'));
            }
        } elseif (!Hash::check($this->password, $admin->password)) {
            $this->addError('password', 'Invalid password');
        }
    }

    public function declineGuarantor()
    {
        $this->validate([
            'guarantor_reason' => 'required'
        ]);

        $this->client->business->update([
            'loan_status' => 'declined',
            'decline_reason' => $this->guarantor_reason,
        ]);

        createAudit('Guarantor information declined, reason:' . $this->guarantor_reason, $this->client);
        dispatch(new SendEmail($this->client->email, $this->client->business->name, 'Guarantor Review', 'Guarantor information submited has been declined, reason:' . $this->guarantor_reason, null, null, 0));
        $this->reset(['guarantor_reason']);
        return redirect()->route('user.manage', ['client' => $this->client->id, 'type' => 'details'])->with('success', 'Guarantor information was successfully rejected');
    }

    public function approveGuarantor()
    {
        $this->validate([
            'g_expiry' => 'required'
        ]);

        if (Carbon::create($this->g_expiry)->lessThan(Carbon::now())) {
            return $this->emit('alert', 'Expiry date must be grater than today');
        }
        $this->client->business->update([
            'loan_status' => "approved",
            'g_expiry' => $this->kyc_expiry,
        ]);
        dispatch(new SendEmail($this->client->email, $this->client->business->name, 'Guarantor Review', 'Guarantor information submited has been approved, you now have access to file loan applications & buy now pay later', null, null, 0));
        createAudit('Guarantor information approved', $this->client);
        return redirect()->route('user.manage', ['client' => $this->client->id, 'type' => 'details'])->with('success', 'Guarantor information was successfully approved');
    }

    public function approveKYC()
    {
        $this->validate([
            'kyc_expiry' => 'required'
        ]);

        if (Carbon::create($this->kyc_expiry)->lessThan(Carbon::now())) {
            return $this->emit('alert', 'Expiry date must be grater than today');
        }

        $this->client->business->update([
            'kyc_status' => "APPROVED",
            'kyc_expiry' => $this->kyc_expiry,
        ]);
        dispatch(new CustomEmail('compliance_approval', $this->client->id));
        createAudit('Compliance approved', $this->client);
        return redirect()->route('user.manage', ['client' => $this->client->id, 'type' => 'details'])->with('success', 'KYC was successfully approved');
    }

    public function declineKYC()
    {
        $this->validate([
            'reason' => 'required'
        ]);
        $this->client->business->update([
            'kyc_status' => 'RESUBMIT',
        ]);
        createAudit('Compliance resubmit, reason:' . $this->reason, $this->client);
        dispatch(new CustomEmail('compliance_resubmit', $this->client->id, $this->reason));
        $this->reset(['reason']);
        return redirect()->route('user.manage', ['client' => $this->client->id, 'type' => 'details'])->with('success', 'KYC was successfully rejected');
    }

    public function render()
    {
        return view('livewire.admin.users.details');
    }
}
