<?php

namespace App\Http\Livewire\Admin\Banks;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;
    public $val;
    public $image;
    

    protected $rules = [
        'val.title' => ['required', 'string', 'max:255'],
        'val.image' => 'nullable',
    ];

    public function delete()
    {
        if($this->val->users->count()){
            return $this->emit('alert', __('Bank can\'t be deleted, users have added this bank already, disable this bank to prevent new users from seeing it'));
        }
        Storage::delete('banks/'.$this->val->image);
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function update()
    {
        $this->validate();
        if ($this->image) {
            $filePath = $this->image->storePublicly('banks');
            Storage::delete('banks/'.$this->val->image);
            $this->val->update([
                'image' => $filePath,
            ]);
            $this->reset(['image']);
        }

        $this->val->update([
            'title' =>  $this->val->title,
        ]);

        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', __('Bank updated'));
    }

    public function render()
    {
        return view('livewire.admin.banks.edit');
    }
}
