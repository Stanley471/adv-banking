<?php

namespace App\Http\Livewire\Admin\Team;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;
    public $val;
    public $image;
    
    protected $rules = [
        'val.name' => ['required', 'string', 'max:255'],
        'val.position' => ['required', 'string', 'max:255'],
        'val.linkedin' => ['nullable', 'url'],
        'val.twitter' => ['nullable', 'url'],
        'val.image' => 'nullable',
    ];

    public function delete()
    {
        Storage::delete('team/'.$this->val->image);
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function update()
    {
        $this->validate();
        if ($this->image) {
            $filePath = $this->image->storePublicly('team');
            Storage::delete('team/'.$this->val->image);
            $this->val->update([
                'image' => $filePath,
            ]);
            $this->reset(['image']);
        }

        $this->val->update([
            'name' =>  $this->val->name,
            'position' =>  $this->val->position,
            'linkedin' =>  $this->val->linkedin,
            'twitter' =>  $this->val->twitter,
        ]);

        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', __('Team updated'));
    }

    public function render()
    {
        return view('livewire.admin.team.edit');
    }
}
