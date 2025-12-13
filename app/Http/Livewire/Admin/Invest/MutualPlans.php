<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\Plans;
use App\Models\PriceHistory;

class MutualPlans extends Component
{

    use WithFileUploads;

    private $plans;
    public $search = "";
    public $category = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $status = 1;
    public $dividend = 0;
    public $sell_units = 1;
    public $fee_type = 'percent';
    public $name;
    public $percent_pc = 1;
    public $fiat_pc;
    public $units;
    public $suitability;
    public $how;
    public $terms;
    public $custodian;
    public $trustee;
    public $prospectus;
    public $recommendation = 1;
    public $claim_duration;
    public $min_sell;
    public $min_buy;
    public $sale_percent;
    public $details = "";
    public $price_history;
    public $image;

    protected $listeners = ['saved' => '$refresh'];

    public function addPlan()
    {
        $startDate = Carbon::now();
        $endDate = Carbon::now()->addDays(6);
        $history = collect(json_decode($this->price_history))->pluck('value')->toArray();

        if(count($history) != 7){
            return $this->addError('price_history', 'Provide 7 unit price for 7 days');
        }
        foreach (Carbon::parse($startDate)->daysUntil($endDate) as $date) {
            $week[] = $date->toDateString();
        }
        $data = array_combine($week, $history);

        $this->validate([
            'status' => ['required'],
            'dividend' => ['required'],
            'sell_units' => ['required'],
            'recommendation' => ['required'],
            'price_history' => ['required'],
            'fee_type' => ['required'],
            'fiat_pc' => ['nullable', 'integer'],
            'percent_pc' => ['nullable', 'numeric'],
            'units' => ['nullable', 'integer'],
            'min_buy' => ['nullable', 'integer'],
            'min_sell' => ['nullable', 'integer'],
            'sale_percent' => ['required', 'numeric'],
            'claim_duration' => ['nullable', 'integer'],
            'name' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string'],
            'suitability' => ['required', 'string'],
            'terms' => ['required', 'string'],
            'how' => ['required', 'string'],
            'custodian' => ['required', 'string', 'max:255'],
            'trustee' => ['required', 'string', 'max:255'],
            'prospectus' => ['nullable', 'url'],
            'image' => 'required|file|mimes:jpeg,png,jpg,webp|max:1024',
        ]);


        $filePath = $this->image->storePublicly('invest');

        $plan = Plans::create([
            'name' =>  $this->name,
            'details' =>  $this->details,
            'slug' =>  Str::slug($this->name, '-'),
            'units' =>  $this->units,
            'min_buy' =>  $this->min_buy,
            'min_sell' =>  $this->min_sell,
            'sale_percent' =>  $this->sale_percent,
            'original' =>  $this->units,
            'claim_duration' =>  $this->claim_duration,
            'suitability' =>  $this->suitability,
            'how' =>  $this->how,
            'terms' =>  $this->terms,
            'custodian' =>  $this->custodian,
            'trustee' =>  $this->trustee,
            'prospectus' =>  $this->prospectus,
            'fee_type' =>  $this->fee_type,
            'fiat_pc' =>  $this->fiat_pc,
            'percent_pc' =>  $this->percent_pc,
            'status' =>  $this->status,
            'dividend' =>  $this->dividend,
            'sell_units' =>  $this->sell_units,
            'recommendation' =>  $this->recommendation,
            'image' => $filePath,
            'type' => 'mutual',
            'created_by' => $this->admin->id,
            'edited_by' => $this->admin->id,
        ]);

        foreach ($data as $key => $val) {
            PriceHistory::create([
                'plan_id' => $plan->id,
                'amount' => $val,
                'date' => $key,
            ]);
        }


        $this->reset(['name', 'details', 'status', 'image', 'fee_type', 'fiat_pc', 'percent_pc', 'units', 'claim_duration', 'suitability', 'terms', 'custodian', 'prospectus', 'recommendation']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Plan Created');
    }

    public function render()
    {
        $this->plans = \App\Models\Plans::whereType('mutual')->when($this->search, function ($query) {
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
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);

        return view('livewire.admin.invest.mutual-plans', ['plans' => $this->plans, 'admin' => $this->admin]);
    }
}
