<?php

namespace App\Http\Livewire\Admin\Helpcenter;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\HelpCenter;
use App\Models\Category;

class EditCategory extends Component
{
    public $val;

    protected $rules = [
        'val.name' => ['required', 'string', 'max:50'],
        'val.description' => ['required', 'string', 'max:255'],
        'val.icon' => ['required', 'string']
    ];

    public function delete()
    {
        if (HelpCenter::wherecatId($this->val->id)->count() > 0) {
            return $this->emit('alert', 'Problem With Deleting Topic, it already used for an existing Faq');
        } else {
            $this->val->delete();
            $this->emit('saved');
            $this->emit('closeModal', $this->val->id);
        }
    }

    public function update(){
        $this->validate();
        $this->val->update([
            'name' =>  $this->val->name, 
            'description' =>  $this->val->description, 
            'icon' =>  $this->val->icon, 
            'slug' => Str::slug($this->val->name)
        ]);
        $this->emit('closeDrawer');
        $this->emitUp('saved');
        $this->emit('success', __('Category updated'));

    }

    public function render()
    {
        return view('livewire.admin.helpcenter.edit-category');
    }
}
