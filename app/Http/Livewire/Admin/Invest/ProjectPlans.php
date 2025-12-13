<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Plans;

class ProjectPlans extends Component
{

    use WithFileUploads;

    private $plans;
    private $categoryAll;
    public $search = "";
    public $category = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $status = 1;
    public $insurance = 0;
    public $fee_type = 'percent';
    public $name;
    public $percent_pc;
    public $fiat_pc;
    public $price;
    public $units;
    public $interest;
    public $duration;
    public $location;
    public $min_buy;
    public $start_date;
    public $close_date;
    public $details = "";
    public $image;
    public $selectCategory;

    protected $listeners = ['saved' => '$refresh'];

    public function addPlan()
    {

        $this->validate([
            'status' => ['required'],
            'insurance' => ['required'],
            'fee_type' => ['required'],
            'fiat_pc' => ['nullable', 'integer'],
            'percent_pc' => ['nullable', 'numeric'],
            'price' => ['required', 'numeric'],
            'interest' => ['required', 'numeric'],
            'units' => ['required', 'integer'],
            'min_buy' => ['nullable', 'integer'],
            'duration' => ['required', 'integer', 'min:1'],
            'selectCategory' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'location' => ['required', 'string'],
            'image' => 'required|file|mimes:jpeg,png,jpg,webp|max:1024',
            'start_date' => 'required|date_format:"Y-m-d"|before:close_date',
            'close_date' => 'required|date_format:"Y-m-d"|after:start_date',
        ]);

        $filePath = $this->image->storePublicly('invest');

        Plans::create([
            'name' =>  $this->name,
            'details' =>  $this->details,
            'slug' =>  Str::slug($this->name, '-'),
            'start_date' => Carbon::createFromFormat('Y-m-d', $this->start_date)->toDateString(),
            'close_date' => Carbon::createFromFormat('Y-m-d', $this->close_date)->toDateString(),
            'price' =>  $this->price,
            'duration' =>  $this->duration,
            'units' =>  $this->units,
            'min_buy' =>  $this->min_buy,
            'original' =>  $this->units,
            'interest' =>  $this->interest,
            'cat_id' =>  $this->selectCategory,
            'location' =>  $this->location,
            'insurance' =>  $this->insurance,
            'fee_type' =>  $this->fee_type,
            'fiat_pc' =>  $this->fiat_pc,
            'percent_pc' =>  $this->percent_pc,
            'status' =>  $this->status,
            'image' => $filePath,
            'created_by' => $this->admin->id,
            'edited_by' => $this->admin->id,
            'expiring_date' => Carbon::createFromFormat('Y-m-d', $this->start_date)->add($this->duration . ' month')->toDateString(),
        ]);
        $this->reset(['name', 'details', 'selectCategory', 'status', 'image', 'insurance', 'fee_type', 'fiat_pc', 'percent_pc', 'price', 'units', 'interest', 'duration', 'location', 'start_date', 'close_date']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Plan Created');
    }

    public function render()
    {
        $this->plans = \App\Models\Plans::whereType('project')->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('category', 'name', 'like', '%' . $this->search . '%')
                        ->orWhere('location', 'like', '%' . $this->search . '%')
                        ->orWhere('details', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->when($this->category, function ($query) {
                return $query->whereCatId($this->category);
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
            $this->categoryAll = Category::whereType('invest')->get();

        return view('livewire.admin.invest.project-plans', ['plans' => $this->plans, 'categoryAll' => $this->categoryAll, 'admin' => $this->admin]);
    }
}
