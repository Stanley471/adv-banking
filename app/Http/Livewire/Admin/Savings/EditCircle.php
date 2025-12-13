<?php

namespace App\Http\Livewire\Admin\Savings;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Savings;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditCircle extends Component
{
    use WithFileUploads;
    public $val;
    public $image;
    public $admin;
    private $categoryAll;
    private $nplans;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";

    protected $rules = [
        'val.name' => ['required', 'string', 'max:255'],
        'val.status' => ['required'],
        'val.circle_duration' => ['required', 'string'],
        'image' => 'nullable',
        'val.amount' => ['required', 'numeric', 'min:1'],
        'val.description' => ['required', 'string'],
        'val.cat_id' => ['required'],
        'val.interest' => ['required', 'numeric'],
    ];

    public function loadMore()
    {
        $this->perPage = $this->perPage + 100;
    }

    public function update()
    {
        $this->validate();

        if ($this->image) {
            $filePath = $this->image->storePublicly('circle');
            Storage::delete('circle/'.$this->val->image);
            $this->val->update([
                'image' => $filePath,
            ]);
            $this->reset(['image']);
        }

        $this->val->update([
            'name' =>  $this->val->name,
            'slug' =>  Str::slug($this->val->name, '-'),
            'amount' =>  $this->val->amount,
            'description' =>  $this->val->description,
            'cat_id' =>  $this->val->cat_id,
            'circle_duration' =>  $this->val->circle_duration,
            'interest' =>  $this->val->interest,
            'status' =>  $this->val->status,
            'edited_by' => $this->admin->id,
        ]);
        if($this->val->status == 0){
            $this->emit('closeDrawer');
        }
        $this->emit('saved');
        $this->emit('success', __('Circle updated'));
    }


    public function delete()
    {
        if ($this->val->savings->count()) {
            return $this->emit('alert', __('Users already have savings on this circle'));
        } else {
            $this->val->delete();
            $this->emit('success', 'Circle deleted');
            $this->emit('saved');
            $this->emit('closeModal', $this->val->id);
        }
    }

    public function render()
    {
        $this->categoryAll = Category::whereType('circle_category')->get();
        $this->nplans = Savings::whereCircleId($this->val->id)->when($this->search, function ($query) {
            $query->where(function ($query) {
                $query->Where('name', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('user', 'first_name', 'like', '%' . $this->search . '%')
                    ->orWhereRelation('user', 'last_name', 'like', '%' . $this->search . '%');
            });
        })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.savings.edit-circle', [
            'categoryAll' => $this->categoryAll,
            'nplans' => $this->nplans
        ]);
    }
}
