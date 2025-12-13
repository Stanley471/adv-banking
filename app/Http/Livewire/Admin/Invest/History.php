<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\PriceHistory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class History extends Component
{
    private $history;
    public $val;
    public $type;
    public $price_history;
    public $perPage = 100;
    public $orderBy = "created_at";
    public $count = 0;
    public $sortBy = "desc";
    public $search = "";

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function addData()
    {
        $startDate = $this->val->priceHistory->last()->date->addDays(1);
        $endDate = $this->val->priceHistory->last()->date->addDays(7);
        $history = collect(json_decode($this->price_history))->pluck('value')->toArray();

        if(count($history) != 7){
            return $this->addError('price_history', 'Provide 7 unit price for 7 days');
        }
        foreach (Carbon::parse($startDate)->daysUntil($endDate) as $date) {
            $week[] = $date->toDateString();
        }
        $data = array_combine($week, $history);

        foreach ($data as $key => $val) {
            PriceHistory::create([
                'plan_id' => $this->val->id,
                'amount' => $val,
                'date' => $key,
            ]);
        }

        $this->val->update(['reminded' => 1]);

        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Plan Created');
        $this->emit('removeAllTags');
    }

    public function render()
    {
        $this->history = PriceHistory::select(
            DB::raw('YEAR(date) as year'),
            DB::raw('WEEK(date) as week'),
            DB::raw('MIN(date) as start_date'),
            DB::raw('MAX(date) as end_date'),
            DB::raw('COUNT(*) as count')
        )->wherePlanId($this->val->id)
            ->groupBy('year', 'week')
            ->orderByDesc('year')
->orderByDesc('week')
            ->get();
        return view('livewire.admin.invest.history', ['history' => $this->history]);
    }
}
