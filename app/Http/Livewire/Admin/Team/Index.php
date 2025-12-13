<?php

namespace App\Http\Livewire\Admin\Team;

use Livewire\Component;
use App\Models\LeaderShip;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    private $teams;
    public $search = "";
    public $category = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $name;
    public $position;
    public $linkedin;
    public $twitter;
    public $image;

    protected $listeners = ['saved' => '$refresh'];

    public function addTeam()
    {

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'position' => ['required', 'string', 'max:255'],
            'linkedin' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'image' => 'required|file|mimes:jpeg,png,jpg|max:1024',
        ]);

        $filePath = $this->image->storePublicly('team');

        LeaderShip::create([
            'name' =>  $this->name,
            'position' =>  $this->position,
            'linkedin' =>  $this->linkedin,
            'twitter' =>  $this->twitter,
            'image' => $filePath,
        ]);
        $this->reset(['name', 'image', 'position', 'linkedin', 'twitter']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Team Created');
    }

    public function disable(LeaderShip $team)
    {
        $team->update(['status' => 0]);
        $this->emit('success', __('Team disabled'));
        $this->emitUp('saved');
    }

    public function enable(LeaderShip $team)
    {
        $team->update(['status' => 1]);
        $this->emit('success', __('Team enabled'));
        $this->emitUp('saved');
    }

    public function render()
    {
        $this->teams = LeaderShip::when($this->search, function ($query) {
            $this->emit('drawer');
            $query->where(function ($query) {
                $query->Where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('position', 'like', '%' . $this->search . '%')
                    ->orWhere('linkedin', 'like', '%' . $this->search . '%')
                    ->orWhere('twitter', 'like', '%' . $this->search . '%');
            });
        })->when($this->search == null, function ($query) {
            $this->emit('searchdrawer');
        })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);

        return view('livewire.admin.team.index', ['teams' => $this->teams]);
    }
}
