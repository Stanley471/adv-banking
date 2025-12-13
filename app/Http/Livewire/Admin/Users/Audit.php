<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;

class Audit extends Component
{
    public $perPage = 100;
    public $admin;
    public $client;
    public $settings;
    public $search = "";
    public $status = "";
    public $priority = "";
    public $orderBy = "created_at";
    public $sortBy = "desc";
    private $audit;


    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function render()
    {
        $this->audit = \App\Models\Audit::whereUserId($this->client->id)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->Where('log', 'like', '%' . $this->search . '%');
                });
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.users.audit', ['audit' => $this->audit]);
    }
}
