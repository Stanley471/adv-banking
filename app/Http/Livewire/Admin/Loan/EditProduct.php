<?php

namespace App\Http\Livewire\Admin\Loan;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditProduct extends Component
{
    use WithFileUploads;
    public $val;
    public $image;
    public $admin;
    private $categoryAll;

    protected $rules = [
        'val.name' => ['required', 'string', 'max:255'],
        'val.status' => ['required'],
        'val.installment' => ['nullable'],
        'val.duration' => ['required', 'integer', 'min:1'],
        'image' => 'nullable',
        'val.amount' => ['required', 'numeric', 'min:1'],
        'val.description' => ['required', 'string'],
        'val.digital_link' => ['nullable', 'url'],
        'val.cat_id' => ['required'],
        'val.product_type' => ['required'],
        'val.interest' => ['required', 'numeric', 'lt:val.failed_interest'],
        'val.failed_interest' => ['required', 'numeric', 'gt:val.interest'],
    ];
    public function update()
    {
        $this->validate();

        if($this->val->installment == 1 && $this->val->duration == 1){
            return $this->addError('duration', 'Duration must be greater than 1 if installment is enabled');
        }

        if ($this->image) {
            $filePath = $this->image->storePublicly('product');
            Storage::delete('product/'.$this->val->image);
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
            'digital_link' =>  $this->val->digital_link,
            'cat_id' =>  $this->val->cat_id,
            'installment' =>  $this->val->installment,
            'duration' =>  $this->val->duration,
            'product_type' =>  $this->val->product_type,
            'interest' =>  $this->val->interest,
            'failed_interest' =>  $this->val->failed_interest,
            'status' =>  $this->val->status,
            'edited_by' => $this->admin->id,
        ]);
        if($this->val->status == 0){
            $this->emit('closeDrawer');
        }
        $this->emit('saved');
        $this->emit('success', __('Product updated'));
    }


    public function delete()
    {
        if ($this->val->users->count()) {
            return $this->emit('alert', __('Users already have loans on this product'));
        } else {
            $this->val->delete();
            $this->emit('success', 'Product deleted');
            $this->emit('saved');
            $this->emit('closeModal', $this->val->id);
        }
    }

    public function render()
    {
        $this->categoryAll = Category::whereType('product')->get();
        return view('livewire.admin.loan.edit-product', ['categoryAll' => $this->categoryAll]);
    }
}
