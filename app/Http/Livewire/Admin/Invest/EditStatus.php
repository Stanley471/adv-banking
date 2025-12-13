<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\Statusimage;
use Livewire\WithFileUploads;

class EditStatus extends Component
{
    use WithFileUploads;

    public $files = [];
    public $filePaths = [];
    public $val;

    protected $listeners = ['saved' => '$refresh'];

    protected $rules = [
        'val.title' => ['required', 'string', 'max:255'],
        'val.stage' => ['required', 'string', 'max:255'],
        'val.weeks' => ['required', 'integer'],
        'val.report' => ['required', 'string'],
    ];

    public function delete()
    {
        $this->val->delete();
        $this->emit('saved');
        $this->emit('closeModal', $this->val->id);
    }    
    
    public function addImage()
    {
        $this->validate([
            'files.*' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:1024',
        ]);
        foreach ($this->files as $file) {
            $path = $file->store('status');
            Statusimage::create([
                'update_id' => $this->val->id,
                'image' => $path,
            ]);
        }

        $this->emit('saved');
        $this->emit('success', __('Uploaded'));
    }

    public function update(){
        $this->validate();
        $this->val->update([
            'title' =>  $this->val->title,
            'stage' =>  $this->val->stage,
            'weeks' =>  $this->val->weeks,
            'report' =>  $this->val->report
        ]);
        $this->emit('saved');
        $this->emit('success', __('Saved'));

    }

    public function render()
    {
        return view('livewire.admin.invest.edit-status');
    }
}
