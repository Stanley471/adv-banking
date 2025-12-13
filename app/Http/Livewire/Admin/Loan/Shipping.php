<?php

namespace App\Http\Livewire\Admin\Loan;

use Livewire\Component;
use App\Models\Category as Topic;

class Shipping extends Component
{
    private $address;
    public $state;
    public $amount;
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

    public function addAddress()
    {
        $this->validate([
            'state' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:1'],
        ]);

        if (Topic::whereType('shipping')->whereStateId($this->state)->count() > 0) {
            return $this->addError('state', 'An address already has this state');
        } else {
            Topic::create([
                'state_id' =>  $this->state,
                'amount' =>  $this->amount,
                'type' => 'shipping'
            ]);
            $this->emit('saved');
            $this->reset(['state', 'amount']);
            $this->emit('closeDrawer');
        }
    }

    public function render()
    {
        $this->address = Topic::whereType('shipping')->when($this->search, function ($query) {
            $this->emit('drawer');
            $query->where(function ($query) {
                $query->WhereRelation('state', 'name', 'like', '%' . $this->search . '%');
            });
        })
        ->when($this->search == null, function ($query) {
            $this->emit('searchdrawer');
        })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.loan.shipping', ['address' => $this->address]);
    }
}
