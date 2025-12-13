<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\Planupdate as Topic;

class Status extends Component
{
    private $category;
    public $val;
    public $type;
    public $plan;
    public $title;
    public $report;
    public $stage;
    public $weeks;
    public $perPage = 100;
    public $orderBy = "created_at";
    public $count = 0;
    public $sortBy = "desc";
    public $search = "";

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function addStatus()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'stage' => ['required', 'string', 'max:255'],
            'weeks' => ['required', 'integer'],
            'report' => ['required', 'string'],
        ]);

            Topic::create([
                'title' =>  $this->title,
                'plan_id' =>  $this->val->id,
                'stage' =>  $this->stage,
                'weeks' =>  $this->weeks,
                'report' =>  $this->report
            ]);
            $this->emit('saved');
            $this->reset(['title', 'stage', 'weeks', 'report']);
            $this->emit('closeDrawer');
    }

    public function render()
    {
        $this->category = Topic::wherePlanId($this->val->id)->when($this->search, function ($query) {
            $this->emit('drawer');
            $query->where(function ($query) {
                $query->Where('title', 'like', '%' . $this->search . '%')
                ->orWhere('report', 'like', '%' . $this->search . '%')
                ->orWhere('stage', 'like', '%' . $this->search . '%')
                ->orWhere('weeks', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->search == null, function ($query) {
            $this->emit('searchdrawer');
        })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.invest.status', ['category' => $this->category]);
    }
}
