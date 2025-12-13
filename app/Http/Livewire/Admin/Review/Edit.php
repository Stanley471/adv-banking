<?php

namespace App\Http\Livewire\Admin\Review;

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
        'val.occupation' => ['required', 'string', 'max:255'],
        'val.review' => ['required', 'string'],
        'val.image' => 'nullable',
    ];

    public function delete()
    {
        Storage::delete('review/'.$this->val->image);
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }

    public function update()
    {
        $this->validate();
        if ($this->image) {
            $filePath = $this->image->storePublicly('review');
            Storage::delete('review/'.$this->val->image);
            $this->val->update([
                'image' => $filePath,
            ]);
            $this->reset(['image']);
        }

        $this->val->update([
            'name' =>  $this->val->name,
            'occupation' =>  $this->val->occupation,
            'review' =>  $this->val->review,
        ]);

        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', __('Review updated'));
    }

    public function render()
    {
        return view('livewire.admin.review.edit');
    }
}
