<?php
namespace App\Http\Livewire\Admin\Services;

use Livewire\Component;

class Edit extends Component
{
    public $val;
    
    protected $rules = [
        'val.title' => ['required', 'string', 'max:255'],
        'val.details' => ['required', 'string'],
        'val.icon' => ['required', 'string', 'max:255'],
    ];

    public function delete()
    {
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function update()
    {
        $this->validate();

        $this->val->update([
            'title' =>  $this->val->title,
            'details' =>  $this->val->details,
            'icon' =>  $this->val->icon,
        ]);

        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', __('Service updated'));
    }

    public function render()
    {
        return view('livewire.admin.services.edit');
    }
}
