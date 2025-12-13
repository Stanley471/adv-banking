<?php

namespace App\Http\Livewire\Admin\Brand;

use Livewire\Component;
use App\Models\Brands;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    private $brands;
    public $search = "";
    public $category = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $title;
    public $image;

    protected $listeners = ['saved' => '$refresh'];

    public function addBrand()
    {

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'image' => 'required|file|mimes:jpeg,png,jpg,svg|max:1024',
        ]);

        $filePath = $this->image->storePublicly('brand');

        Brands::create([
            'title' =>  $this->title,
            'image' => $filePath,
        ]);
        $this->reset(['title', 'image']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Brand Created');
    }

    public function disable(Brands $brand){
        $brand->update(['status' => 0]);
        $this->emit('success', __('Brand disabled'));
        $this->emitUp('saved');
    }
    
    public function enable(Brands $brand){
        $brand->update(['status' => 1]);
        $this->emit('success', __('Brand enabled'));
        $this->emitUp('saved');
    }

    public function render()
    {
        $this->brands = Brands::when($this->search, function ($query) {
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

        return view('livewire.admin.brand.index', ['brands' => $this->brands]);
    }
}
