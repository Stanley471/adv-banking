<?php

namespace App\Http\Livewire\Admin\Banks;

use Livewire\Component;
use App\Models\Banks;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    private $banks;
    public $search = "";
    public $category = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $title;
    public $image;

    protected $listeners = ['saved' => '$refresh'];

    public function addBank()
    {

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => 'required|file|mimes:jpeg,png,jpg|max:1024',
        ]);

        $filePath = $this->image->storePublicly('banks');

        Banks::create([
            'title' =>  $this->title,
            'image' => $filePath,
        ]);
        $this->reset(['title', 'image']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Bank Created');
    }

    public function disable(Banks $bank){
        $bank->update(['status' => 0]);
        $this->emit('success', __('Bank disabled'));
        $this->emitUp('saved');
    }
    
    public function enable(Banks $bank){
        $bank->update(['status' => 1]);
        $this->emit('success', __('Bank enabled'));
        $this->emitUp('saved');
    }

    public function render()
    {
        $this->banks = Banks::when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->Where('title', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);

        return view('livewire.admin.banks.index', ['banks' => $this->banks]);
    }
}
