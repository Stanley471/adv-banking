<?php

namespace App\Http\Livewire\Admin\Loan;

use Livewire\Component;
use App\Models\LoanApplicants;

class Others extends Component
{
    public $perPage = 200;
    public $admin;
    public $set;
    public $search = "";
    public $date;
    public $type;
    public $sortBy = "created_at";
    public $orderBy = "desc";

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + 10;
        $this->emit('drawer');
    }

    public function render()
    {
        $page = $this->pages();
        return view('livewire.admin.loan.others', ['transactions' => $page->paginate($this->perPage)]);
    }

    protected function pages()
    {
        return LoanApplicants::with(['user'])
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->where('amount', 'like', '%' . $this->search . '%')
                        ->orWhere('ref_id', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'first_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->when($this->type == 'pending', function ($query) {
                $query->whereStatus('pending');
            })
            ->when($this->type == 'active', function ($query) {
                $query->whereStatus('running')->whereDefaulter(0);
            })
            ->when($this->type == 'completed', function ($query) {
                $query->whereStatus('paid')->whereDefaulter(0);
            })
            ->when($this->type == 'defaulters', function ($query) {
                $query->whereStatus('running')->whereDefaulter(1);
            })
            ->orderby($this->sortBy, $this->orderBy);
    }
}
