<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Plans;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Edit extends Component
{
    use WithFileUploads;
    public $val;
    public $image;
    public $admin;
    public $type;
    private $categoryAll;

    protected $rules = [
        'val.status' => ['required'],
        'val.insurance' => ['required'],
        'val.fee_type' => ['required'],
        'val.fiat_pc' => ['nullable', 'integer'],
        'val.percent_pc' => ['nullable', 'numeric'],
        'val.price' => ['required', 'numeric'],
        'val.interest' => ['required', 'numeric'],
        'val.units' => ['required', 'integer'],
        'val.min_buy' => ['nullable', 'integer'],
        'val.duration' => ['required', 'integer'],
        'val.cat_id' => ['required'],
        'val.name' => ['required', 'string', 'max:255'],
        'val.details' => ['required', 'string'],
        'val.location' => ['required', 'string'],
        'val.image' => 'nullable',
        'val.start_date' => 'required|date_format:"Y-m-d"|before:close_date',
        'val.close_date' => 'required|date_format:"Y-m-d"|after:start_date',
    ];

    public function mount(){
        $this->val->start_date = Carbon::createFromFormat('Y-m-d H:i:s',$this->val->start_date)->format('Y-m-d');
        $this->val->close_date = Carbon::createFromFormat('Y-m-d H:i:s',$this->val->close_date)->format('Y-m-d');
    }

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

        $plan = Plans::whereId($this->val->id)->first();
        if($plan->start_date!= $this->val->start_date || $plan->duration!= $this->val->duration){
            $this->val->update([
                'duration' =>  $this->val->duration,
                'expiring_date' => Carbon::createFromFormat('Y-m-d', $this->val->start_date)->add($this->val->duration . ' month')->toDateString(),
            ]);
        }
        $this->val->update([
            'name' =>  $this->val->name,
            'details' =>  $this->val->details,
            'slug' =>  Str::slug($this->val->name, '-'),
            'start_date' => Carbon::createFromFormat('Y-m-d', $this->val->start_date)->toDateString(),
            'close_date' => Carbon::createFromFormat('Y-m-d', $this->val->close_date)->toDateString(),
            'price' =>  $this->val->price,
            'units' =>  $this->val->units,
            'min_buy' =>  $this->val->min_buy,
            'original' =>  $this->val->units,
            'interest' =>  $this->val->interest,
            'cat_id' =>  $this->val->cat_id,
            'location' =>  $this->val->location,
            'insurance' =>  $this->val->insurance,
            'fee_type' =>  $this->val->fee_type,
            'fiat_pc' =>  $this->val->fiat_pc,
            'percent_pc' =>  $this->val->percent_pc,
            'status' =>  $this->val->status,
            'edited_by' => $this->admin->id,
        ]);
        $this->emit('closeDrawer');
        $this->emit('saved');
        $this->emit('success', __('Plan updated'));
    }

    public function render()
    {
        $this->categoryAll = Category::whereType('invest')->get();
        return view('livewire.admin.invest.edit', ['categoryAll' => $this->categoryAll]);
    }
}
