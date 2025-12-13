<?php

namespace App\Http\Livewire\Admin\Savings;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\LoanPlans as Plan;
use App\Models\Category;
use Livewire\WithFileUploads;
use Carbon\Carbon;

class Circle extends Component
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
    public $name;
    public $amount;
    public $image;
    public $interest;
    public $cat_id;
    public $circle_duration = "weekly";
    public $description;

    protected $listeners = ['saved' => '$refresh'];

    public function addPlan()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required'],
            'circle_duration' => ['required', 'string'],
            'image' => 'required|file|mimes:jpeg,png,jpg,webp|max:1024',
            'amount' => ['required', 'numeric', 'min:1'],
            'description' => ['required', 'string'],
            'selectCategory' => ['required'],
            'interest' => ['required', 'numeric'],
        ]);

        $filePath = $this->image->storePublicly('circle');

        Category::create([
            'name' =>  $this->name,
            'slug' =>  Str::slug($this->name, '-'),
            'amount' =>  $this->amount,
            'description' =>  $this->description,
            'cat_id' =>  $this->selectCategory,
            'circle_duration' =>  $this->circle_duration,
            'interest' =>  $this->interest,
            'status' =>  $this->status,
            'image' => $filePath,
            'type' => 'circle',
            'expiry_date' => Carbon::today()->addYear(1)->toDateString(),
            'created_by' => $this->admin->id,
            'edited_by' => $this->admin->id,
        ]);


        $this->reset(['name', 'status', 'circle_duration', 'amount', 'description', 'selectCategory', 'interest']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Circle Created');
    }

    public function render()
    {
        $this->plans = Category::whereType('circle')
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->cat_id != null, function ($query) {
                $query->where(function ($query) {
                    $query->Where('cat_id', 'like', '%' . $this->cat_id . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        $this->categoryAll = Category::whereType('circle_category')->get();

        return view('livewire.admin.savings.circle', ['plans' => $this->plans, 'admin' => $this->admin, 'categoryAll' => $this->categoryAll]);
    }
}
