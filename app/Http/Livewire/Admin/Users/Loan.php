<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;
use App\Models\LoanApplicants;

class Loan extends Component
{
    public $perPage = 100;
    public $admin;
    public $client;
    public $search = "";
    public $orderBy = "created_at";
    public $count = 0;
    public $sortBy = "desc";
    private $loan;

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function render()
    {
        $this->loan = LoanApplicants::whereUserId($this->client->id)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->WhereRelation('user', 'first_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('plan', 'name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('plan', 'description', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.users.loan', ['loan' => $this->loan]);
    }
}
