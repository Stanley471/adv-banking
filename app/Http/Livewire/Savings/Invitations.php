<?php

namespace App\Http\Livewire\Savings;

use Livewire\Component;
use App\Models\Savings;
use Illuminate\Support\Str;
use App\Jobs\SendEmail;
use Carbon\Carbon;

class Invitations extends Component
{
    public $user;
    public $settings; 

    protected $listeners = ['saved' => '$refresh'];

    public function accept($plan){
        $plan = Savings::whereId($plan)->first();
        dispatch(new SendEmail($plan->user->email, $plan->user->business->name, 'Invitation Accepted', $this->user->business->name . ' has accepted your invitation to join '.$plan->name.' saving plan', null, null, 0));
        $plan->update(['joined_status' => 'accepted']);
        $this->emit('saved');
        $this->emit('success', __('Invitation accepted'));
    }

    public function decline($plan){
        $plan = Savings::whereId($plan)->first();
        dispatch(new SendEmail($plan->user->email, $plan->user->business->name, 'Invitation Declined', $this->user->business->name . ' has declined your invitation to join '.$plan->name.' saving plan', null, null, 0));
        $plan->update(['joined_status' => 'declined']);
        $this->emit('saved');
        $this->emit('success', __('Invitation declined'));
    }

    public function cancel($plan){
        $plan = Savings::whereId($plan)->first();
        $plan->delete();
        $this->emit('saved');
        $this->emit('success', __('Invitation canceled'));
    }

    public function resend($plan){
        $plan = Savings::whereId($plan)->first();
        $this->emit('saved');
        if (Carbon::parse($plan->resend_time)->addHours(1) > Carbon::now()) {
            return $this->emit('alert', 'You can resend link after ' . gmdate('i:s', Carbon::parse($plan->resend_time)->addhours(1)->diffInSeconds(Carbon::now())) . ' minutes');
        } else {
            $this->user->update([
                'resend_time' => Carbon::now()->addHours(1)
            ]);
            dispatch(new SendEmail($plan->partner->email, $plan->partner->business->name, 'Join Duo Saving Plan', $this->user->business->name . ' has invited you to join a duo saving plan, click the link below to join saving plan.<br><a href=' . route('duo.plan', ['plan' => $plan->ref_id]) . '>' . route('duo.plan', ['plan' => $plan->ref_id]) . '</a>', null, null, 0));
            $this->emit('success', __('Invitation sent'));
        }
    }

    public function render()
    {
        return view('livewire.savings.invitations');
    }
}
