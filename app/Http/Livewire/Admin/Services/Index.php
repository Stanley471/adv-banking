<?php

namespace App\Http\Livewire\Admin\Services;

use Livewire\Component;
use App\Models\Services;

class Index extends Component
{
    private $services;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $title;
    public $details;
    public $icon;

    protected $listeners = ['saved' => '$refresh'];

    public function addService()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'icon' => ['required', 'string', 'max:255'],
        ]);

        Services::create([
            'title' =>  $this->title,
            'details' =>  $this->details,
            'icon' =>  $this->icon,
        ]);
        $this->reset(['title', 'details', 'icon']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Service Created');
    }

    public function render()
    {
        $this->services = Services::when($this->search, function ($query) {
            $this->emit('drawer');
            $query->where(function ($query) {
                $query->Where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('details', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->search == null, function ($query) {
            $this->emit('searchdrawer');
        })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);

        return view('livewire.admin.services.index', ['services' => $this->services]);
    }
}
