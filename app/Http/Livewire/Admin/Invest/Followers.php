<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\Followed;

class Followers extends Component
{
    public $perPage = 100;
    public $val;
    public $search = "";
    public $orderBy = "created_at";
    public $count = 0;
    public $sortBy = "desc";
    private $followers;
    public $admin;
    public $type;

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function render()
    {
        $this->followers = Followed::wherePlanId($this->val->id)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->WhereRelation('user', 'first_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.admin.invest.followers', ['followers' => $this->followers]);
    }
}
