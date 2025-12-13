<?php

namespace App\Http\Livewire\Admin\Page;

use Livewire\Component;
use App\Models\Page;
use Illuminate\Support\Str;

class Index extends Component
{
    private $page;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $title;
    public $details;
    public $slug;

    protected $listeners = ['saved' => '$refresh'];

    public function addPage()
    {
        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
        ]);

        Page::create([
            'title' =>  $this->title,
            'details' =>  $this->details,
            'slug' => Str::slug($this->title)
        ]);
        $this->reset(['title', 'details']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Page Created');
    }

    public function render()
    {
        $this->page = Page::when($this->search, function ($query) {
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

        return view('livewire.admin.page.index', ['page' => $this->page]);
    }
}
