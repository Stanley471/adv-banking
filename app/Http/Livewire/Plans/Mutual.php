<?php

namespace App\Http\Livewire\Plans;

use Livewire\Component;
use App\Jobs\SendEmail;
use App\Models\Followed;
use App\Models\Plans as Invest;

class Mutual extends Component
{
    private $plans;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $user;
    public $type;
    public $settings;

    protected $listeners = ['saved' => '$refresh'];

    public function follow(Invest $plan){
        if($this->user->followedPlan($plan->id) == false){
            Followed::create([
                'user_id' => $this->user->id,
                'plan_id' => $plan->id,
            ]);
            dispatch(new SendEmail($this->settings->email, $this->settings->site_name, 'New Follower', 'Hello admin, '.$this->user->business->name.' follwed plan ' . $plan->name, null, null, 0));
        }else{
            $this->emit('alert', $plan->name.__(' already added to your porfolio'));
        }
        $this->emit('success', $plan->name.__(' has been added to your porfolio'));
    }

    public function render()
    {
        $this->plans = \App\Models\Plans::whereStatus(1)->whereType('mutual')
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('suitability', 'like', '%' . $this->search . '%')
                        ->orWhere('terms', 'like', '%' . $this->search . '%')
                        ->orWhere('trustee', 'like', '%' . $this->search . '%')
                        ->orWhere('custodian', 'like', '%' . $this->search . '%')
                        ->orWhere('prospectus', 'like', '%' . $this->search . '%')
                        ->orWhere('details', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->when($this->type == 'recommended', function ($query) {
                return $query->whereRecommendation(1);
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.plans.mutual', ['plans' => $this->plans]);
    }
}
