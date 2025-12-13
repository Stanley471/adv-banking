<?php

namespace App\Http\Livewire\Admin\Savings;

use Livewire\Component;
use App\Models\Savings;

class Duo extends Component
{
    public $type;
    public $settings;
    public $admin;
    public $dsi;
    public $dss;
    public $dgg;
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

    public function mount()
    {
        $this->dsi = $this->settings->dsi;
        $this->dss = $this->settings->dss;
        $this->dgg = $this->settings->dgg;
    }

    public function save()
    {
        $this->validate([
            'dsi' => ['required', 'numeric'],
        ]);
        $this->settings->update([
            'dsi' => $this->dsi,
            'dss' => $this->dss,
            'dgg' => $this->dgg
        ]);
        $this->emit('success', 'Settings updated');
    }

    public function render()
    {
        $this->plans = Savings::whereType('duo')->whereJoinedStatus('accepted')
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'first_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'last_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('partner', 'first_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('partner', 'last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.savings.duo', ['plans' => $this->plans]);
    }
}
