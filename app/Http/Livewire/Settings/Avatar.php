<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Avatar extends Component
{
    use WithFileUploads;
    public $user;
    public $avatar;

    public function save()
    {
        $this->validate([
            'avatar' => 'required|file|mimes:jpeg,png,jpg|max:1024',
        ], ['avatar.required' => 'Select an Image']);

        if ($this->user->avatar) {
            Storage::delete('avatar/' . $this->user->avatar);
        }
        $this->user->update([
            'avatar' => $this->avatar->storePublicly('avatar'),
        ]);

        $this->emit('avatar');
        $this->emit('success', 'Avatar uploaded');
    }

    public function render()
    {
        return view('livewire.settings.avatar');
    }
}
