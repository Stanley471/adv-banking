<?php

namespace App\Http\Livewire\Plans;

use Livewire\Component;
use Carbon\Carbon;
use App\Jobs\SendEmail;
use App\Models\Category;
use App\Models\Followed;
use App\Models\Plans as Invest;

class Project extends Component
{
    private $plans;
    private $categoryAll;
    public $search = "";
    public $category = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $type;
    public $user;
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
        $this->plans = \App\Models\Plans::whereStatus(1)->whereType('project')
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('category', 'name', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%')
                        ->orWhere('details', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->when($this->category, function ($query) {
                return $query->whereCatId($this->category);
            })
            ->when($this->type == 'active', function ($query) {
                return $query->where('start_date', '<=', Carbon::now()->toDateTimeLocalString())->where('expiring_date', '>', Carbon::now()->toDateTimeLocalString());
            })
            ->when($this->type == 'coming', function ($query) {
                return $query->where('start_date', '>', Carbon::now()->toDateTimeLocalString());
            })
            ->when($this->type == 'closed', function ($query) {
                return $query->where('expiring_date', '<', Carbon::now()->toDateTimeLocalString());
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
            $this->categoryAll = Category::whereType('invest')->get();
        return view('livewire.plans.project', ['plans' => $this->plans, 'categoryAll' => $this->categoryAll]);
    }
}
