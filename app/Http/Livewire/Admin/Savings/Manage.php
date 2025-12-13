<?php

namespace App\Http\Livewire\Admin\Savings;

use Livewire\Component;
use App\Models\Transactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class Manage extends Component
{
    public $admin;
    public $settings;
    public $plan;
    public $from;
    public $to;
    public $duration;
    private $recent;
    public $perPage = 100;
    public $sortBy = "created_at";
    public $orderBy = "desc";
    public $search = "";

    protected $listeners = ['saved' => '$refresh'];

    public function mount()
    {
        if ($this->plan->type == 'emergency' || $this->plan->type == 'duo') {
            $this->from = $this->plan->expiry_date->subYear(1)->format('M j, Y');
            $this->to = $this->plan->expiry_date->format('M j, Y');
        }
        if($this->plan->type == 'circle' || $this->plan->type == 'emergency'){
            $this->duration = $this->plan->day;
        }
    }

    public function loadMore()
    {
        $this->perPage = $this->perPage + 10;
        $this->emit('drawer');
    }

    public function render()
    {
        $trx = Transactions::whereSaveId($this->plan->id)->with(['user', 'business'])
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->where('amount', 'like', '%' . $this->search . '%')
                        ->orWhere('charge', 'like', '%' . $this->search . '%')
                        ->orWhere('ref_id', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'first_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->sortBy, $this->orderBy)->get();

        $this->recent = $trx->groupBy(function ($item) {
            return $item->created_at->format('Y-m-d');
        });

        $paginatedGroups = new LengthAwarePaginator(
            $this->recent->forPage(request('page'), $this->perPage), // Groups for the current page
            $this->recent->count(), // Total number of groups
            $this->perPage, // Groups per page
            Paginator::resolveCurrentPage(), // Current page number
            ['path' => Paginator::resolveCurrentPath()] // Additional options
        );

        $first = ($this->plan->type == 'circle') ? $this->plan->circle->savings->whereNotNull('amount')->first() : null;

        return view('livewire.admin.savings.manage', ['transactions' => $trx, 'group' => $paginatedGroups, 'first' => $first]);
    }
}
