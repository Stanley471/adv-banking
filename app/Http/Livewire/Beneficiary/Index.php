<?php

namespace App\Http\Livewire\Beneficiary;

use Livewire\Component;
use App\Models\Beneficiary;
use App\Models\User;

class Index extends Component
{
    public $perPage = 100;
    public $user;
    public $amount;
    public $merchantId;
    public $search = "";
    public $orderBy = "created_at";
    public $count = 0;
    public $sortBy = "desc";
    private $beneficiary;

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + $this->perPage;
        $this->emit('drawer');
    }

    public function addBeneficiary()
    {
        $this->validate([
            'merchantId' => ['required', 'string', 'min:6', 'max:6'],
        ]);

        if (Beneficiary::whereMerchantId($this->merchantId)->whereUserId($this->user->id)->exists()) {
            return $this->addError('added', __('Beneficiary already added'));
        }

        if ($this->merchantId == $this->user->merchant_id) {
            return $this->addError('added', __('You can\'t add your self as a beneficiary'));
        }

        Beneficiary::create([
            'user_id' => $this->user->id,
            'beneficiary_id' => User::whereMerchantId($this->merchantId)->first()->id,
            'merchant_id' => $this->merchantId,
        ]);
        $this->reset(['merchantId']);
        $this->emit('closeDrawer');
        $this->emit('success', 'Beneficiary added');
    }

    public function render()
    {
        $this->beneficiary = Beneficiary::whereUserId($this->user->id)
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->Where('merchant_id', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('beneficiary', 'first_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('beneficiary', 'last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->orderby($this->orderBy, $this->sortBy)
            ->paginate($this->perPage);
        return view('livewire.beneficiary.index', ['beneficiary' => $this->beneficiary]);
    }
}
