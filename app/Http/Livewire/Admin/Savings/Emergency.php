<?php

namespace App\Http\Livewire\Admin\Savings;

use Livewire\Component;
use App\Models\Savings;

class Emergency extends Component
{
    public $type;
    public $settings;
    public $admin;
    public $ega;
    public $egi;
    public $min_ega;
    public $ess;
    public $egg;
    private $plans;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + 100;
    }

    public function mount(){
        $this->ega = $this->settings->ega;
        $this->egi = $this->settings->egi;
        $this->min_ega = $this->settings->min_ega;
        $this->ess = $this->settings->ess;
        $this->egg = $this->settings->egg;
    }

    public function save(){
        $this->validate([
            'ega' => ['required', 'string'],
            'egi' => ['required', 'numeric'],
            'min_ega' => ['required', 'numeric'],
        ]);
        $this->settings->update([
            'ega' => $this->ega,
            'egi' => $this->egi,
            'min_ega' => $this->min_ega,
            'ess' => $this->ess,
            'egg' => $this->egg
        ]);
        $this->emit('success', 'Settings updated');
    }

    public function render()
    {
        $this->plans = Savings::whereType('emergency')->when($this->search, function ($query) {
            $query->where(function ($query) {
                $query->Where('name', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('user', 'first_name', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('user', 'last_name', 'like', '%' . $this->search . '%');
            });
        })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.savings.emergency', ['plans' => $this->plans]);
    }
}
