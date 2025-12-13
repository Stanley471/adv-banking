<?php

namespace App\Http\Livewire\Admin\Kyc;

use Livewire\Component;
use App\Models\KycDoc;

class Index extends Component
{

    private $kyc;
    public $search = "";
    public $category = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $title;
    public $min;
    public $max;
    public $type;

    protected $listeners = ['saved' => '$refresh'];

    public function addKYC()
    {

        $this->validate([
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'min' => ['required', 'integer'],
            'max' => ['required', 'integer'],
        ]);

        KycDoc::create([
            'title' =>  $this->title,
            'type' =>  $this->type,
            'min' => $this->min,
            'max' => $this->max,
        ]);
        $this->reset(['title', 'type', 'min', 'max']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'KYC Doc Created');
    }

    public function disable(KycDoc $kyc){
        $kyc->update(['status' => 0]);
        $this->emit('success', __('KYC Doc disabled'));
        $this->emitUp('saved');
    }
    
    public function enable(KycDoc $kyc){
        $kyc->update(['status' => 1]);
        $this->emit('success', __('KYC Doc enabled'));
        $this->emitUp('saved');
    }

    public function render()
    {
        $this->kyc = KycDoc::when($this->search, function ($query) {
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

        return view('livewire.admin.kyc.index', ['kyc' => $this->kyc]);
    }
}
