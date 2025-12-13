<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EditMutual extends Component
{
    use WithFileUploads;
    public $val;
    public $image;
    public $admin;
    public $type;

    protected $rules = [
        'val.status' => ['required'],
        'val.dividend' => ['required'],
        'val.sell_units' => ['required'],
        'val.recommendation' => ['required'],
        'val.fee_type' => ['required'],
        'val.fiat_pc' => ['nullable', 'integer'],
        'val.percent_pc' => ['nullable', 'numeric'],
        'val.units' => ['nullable', 'integer'],
        'val.min_buy' => ['nullable', 'integer'],
        'val.min_sell' => ['nullable', 'integer'],
        'val.sale_percent' => ['required', 'numeric'],
        'val.claim_duration' => ['nullable', 'integer'],
        'val.name' => ['required', 'string', 'max:255'],
        'val.details' => ['required', 'string'],
        'val.suitability' => ['required', 'string'],
        'val.terms' => ['required', 'string'],
        'val.how' => ['required', 'string'],
        'val.custodian' => ['required', 'string', 'max:255'],
        'val.trustee' => ['required', 'string', 'max:255'],
        'val.prospectus' => ['nullable', 'url'],
        'val.image' => 'nullable',
    ];

    public function update()
    {
        $this->validate();
        if ($this->image) {
            $filePath = $this->image->storePublicly('invest');
            Storage::delete('invest/'.$this->val->image);
            $this->val->update([
                'image' => $filePath,
            ]);
        }

        $this->val->update([
            'name' =>  $this->val->name,
            'details' =>  $this->val->details,
            'slug' =>  Str::slug($this->val->name, '-'),
            'units' =>  $this->val->units,
            'min_buy' =>  $this->val->min_buy,
            'min_sell' =>  $this->val->min_sell,
            'sale_percent' =>  $this->val->sale_percent,
            'original' =>  $this->val->units,
            'claim_duration' =>  $this->val->claim_duration,
            'suitability' =>  $this->val->suitability,
            'terms' =>  $this->val->terms,
            'how' =>  $this->val->how,
            'custodian' =>  $this->val->custodian,
            'trustee' =>  $this->val->trustee,
            'prospectus' =>  $this->val->prospectus,
            'fee_type' =>  $this->val->fee_type,
            'fiat_pc' =>  $this->val->fiat_pc,
            'percent_pc' =>  $this->val->percent_pc,
            'status' =>  $this->val->status,
            'dividend' =>  $this->val->dividend,
            'sell_units' =>  $this->val->sell_units,
            'recommendation' =>  $this->val->recommendation,
            'edited_by' => $this->admin->id,
        ]);
        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', __('Plan updated'));
    }

    public function render()
    {
        return view('livewire.admin.invest.edit-mutual');
    }
}
