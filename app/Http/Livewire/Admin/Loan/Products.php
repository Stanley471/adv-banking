<?php

namespace App\Http\Livewire\Admin\Loan;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\LoanPlans as Plan;
use App\Models\Category;
use Livewire\WithFileUploads;

class Products extends Component
{
    use WithFileUploads;

    private $plans;
    private $categoryAll;
    public $selectCategory;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $status = 1;
    public $installment = 0;
    public $name;
    public $amount;
    public $image;
    public $interest;
    public $failed_interest;
    public $duration;
    public $description;
    public $digital_link;
    public $product_type = 'digital';

    protected $listeners = ['saved' => '$refresh'];

    public function addPlan()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required'],
            'installment' => ['nullable'],
            'duration' => ['required', 'integer', 'min:1'],
            'image' => 'required|file|mimes:jpeg,png,jpg,webp|max:1024',
            'amount' => ['required', 'numeric', 'min:1'],
            'description' => ['required', 'string'],
            'digital_link' => [($this->product_type == 'digital') ? 'required' : 'nullable', 'url'],
            'selectCategory' => ['required'],
            'product_type' => ['required'],
            'interest' => ['required', 'numeric', 'lt:failed_interest'],
            'failed_interest' => ['required', 'numeric', 'gt:interest'],
        ]);

        $filePath = $this->image->storePublicly('product');

        if($this->installment == 1 && $this->duration == 1){
            return $this->addError('duration', 'Duration must be greater than 1 if installment is enabled');
        }

        Plan::create([
            'name' =>  $this->name,
            'slug' =>  Str::slug($this->name, '-'),
            'amount' =>  $this->amount,
            'description' =>  $this->description,
            'digital_link' =>  $this->digital_link,
            'cat_id' =>  $this->selectCategory,
            'installment' =>  $this->installment,
            'duration' =>  $this->duration,
            'product_type' =>  $this->product_type,
            'interest' =>  $this->interest,
            'failed_interest' =>  $this->failed_interest,
            'status' =>  $this->status,
            'image' => $filePath,
            'type' => 'product',
            'created_by' => $this->admin->id,
            'edited_by' => $this->admin->id,
        ]);


        $this->reset(['name', 'status', 'installment', 'duration', 'amount', 'description', 'product_type', 'digital_link', 'selectCategory', 'interest', 'failed_interest']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Product Created');
    }

    public function render()
    {
        $this->plans = Plan::whereType('product')->when($this->search, function ($query) {
            $this->emit('drawer');
            $query->where(function ($query) {
                $query->Where('name', 'like', '%' . $this->search . '%');
            });
        })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
            $this->categoryAll = Category::whereType('product')->get();

        return view('livewire.admin.loan.products', ['plans' => $this->plans, 'admin' => $this->admin, 'categoryAll' => $this->categoryAll]);
    }
}
