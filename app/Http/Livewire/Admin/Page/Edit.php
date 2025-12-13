<?php
namespace App\Http\Livewire\Admin\Page;

use Livewire\Component;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $val;
    
    protected $rules = [
        'val.title' => ['required', 'string', 'max:255'],
        'val.details' => ['required', 'string'],
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
            'slug' => Str::slug($this->val->title)
        ]);

        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', __('Page updated'));
    }

    public function render()
    {
        return view('livewire.admin.page.edit');
    }
}
