<?php

namespace App\Http\Livewire\Admin\Withdraw;

use Livewire\Component;
use App\Models\Category;

class Index extends Component
{

    private $methods;
    public $search = "";
    public $perPage = 100;
    public $orderBy = "created_at";
    public $sortBy = "desc";
    public $admin;
    public $name;
    public $min;
    public $max;
    public $requirements;
    public $fc;
    public $pc;
    public $status = 1;

    protected $listeners = ['saved' => '$refresh'];

    public function addMethod()
    {

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'min' => ['required', 'integer', 'lt:max'],
            'max' => ['required', 'integer', 'gte:min'],
            'status' => ['required'],
            'requirements' => ['required'],
            'fc' => ['required', 'numeric'],
            'pc' => ['required', 'numeric'],
        ]);

        Category::create([
            'name' =>  $this->name,
            'min' => $this->min,
            'max' => $this->max,
            'status' => $this->status,
            'requirements' => $this->requirements,
            'fc' => $this->fc,
            'pc' => $this->pc,
            'type' => 'withdraw',
        ]);
        $this->reset(['name', 'min', 'max', 'status', 'requirements', 'fc', 'pc']);
        $this->emit('saved');
        $this->emit('closeDrawer');
        $this->emit('success', 'Payout Method Created');
    }

    public function disable(Category $method)
    {
        $method->update(['status' => 0]);
        $this->emit('success', __('Method disabled'));
        $this->emitUp('saved');
    }

    public function enable(Category $method)
    {
        $method->update(['status' => 1]);
        $this->emit('success', __('Method enabled'));
        $this->emitUp('saved');
    }

    public function render()
    {
        $this->methods = Category::whereType('withdraw')
            ->when($this->search, function ($query) {
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

        return view('livewire.admin.withdraw.index', ['methods' => $this->methods]);
    }
}
