<?php

namespace App\Http\Livewire\Admin\Country;

use Livewire\Component;
use App\Models\CountryReg;
use App\Models\Country;

class Index extends Component
{

    private $countries;
    private $allCurrency;
    public $search = "";
    public $category = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $country;

    protected $listeners = ['saved' => '$refresh'];

    public function getAll(){
        $all = [];
        foreach (Country::all() as $val) {
            if (!CountryReg::whereCountryId($val->id)->exists()) {
                $all[] = $val;
            }
        }
        return $all;
    }

    public function mount(){

        $this->allCurrency = $this->getAll();
    }

    public function addCountry()
    {

        $this->validate([
            'country' => ['required'],
        ]);

        CountryReg::create([
            'country_id' =>  $this->country,
        ]);
        $this->allCurrency = $this->getAll();
        $this->reset(['country']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Country Created');
    }

    public function disable(CountryReg $currency)
    {
        $currency->update(['status' => 0]);
        $this->emit('success', __('Country disabled'));
        $this->emitUp('saved');
    }

    public function enable(CountryReg $currency)
    {
        $currency->update(['status' => 1]);
        $this->emit('success', __('Country enabled'));
        $this->emitUp('saved');
    }

    public function render()
    {
        $this->countries = CountryReg::with(['real'])->when($this->search, function ($query) {
            $this->emit('drawer');
            $query->where(function ($query) {
                $query->WhereRelation('real', 'name', 'like', '%' . $this->search . '%');
            });
        })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
            $this->allCurrency = $this->getAll();
        return view('livewire.admin.country.index', ['allCurrency' => $this->allCurrency, 'countries' => $this->countries]);
    }
}
