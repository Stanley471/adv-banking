<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class StatusImages extends Component
{
    protected $listeners = ['saved' => '$refresh'];

    public $val;  
    
    public function delete()
    {
        Storage::delete('status/'.$this->val->image);
        $this->val->delete();
        $this->emit('saved');
    }    

    public function render()
    {
        return view('livewire.admin.invest.status-images');
    }
}
