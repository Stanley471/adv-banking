<?php

namespace App\Http\Livewire\Admin\Savings;

use Livewire\Component;
use App\Models\Category;
use App\Models\Savings;
use Carbon\Carbon;

class Regular extends Component
{
    private $regular;
    public $type;
    public $settings;
    public $admin;
    public $rga;
    public $min_rga;
    public $rss;
    public $duration;
    public $interest;
    private $aplans;
    public $asearch = "";
    public $aperPage = 100;
    public $aorderBy = "created_at";
    public $asortBy = "desc";
    private $eplans;
    public $esearch = "";
    public $eperPage = 100;
    public $eorderBy = "created_at";
    public $esortBy = "desc";

    protected $listeners = ['saved' => '$refresh'];

    public function mount()
    {
        $this->rga = $this->settings->rga;
        $this->min_rga = $this->settings->min_rga;
        $this->rss = $this->settings->rss;
    }

    public function save()
    {
        $this->validate([
            'rga' => ['required', 'string'],
            'min_rga' => ['required', 'numeric'],
        ]);
        $this->settings->update([
            'rga' => $this->rga,
            'min_rga' => $this->min_rga,
            'rss' => $this->rss
        ]);
        $this->emit('success', 'Settings updated');
    }

    public function addPlan()
    {
        $this->validate([
            'duration' => ['required', 'integer'],
            'interest' => ['required', 'numeric'],
        ]);

        if (Category::whereType('regular')->whereDuration($this->duration)->count() > 0) {
            return $this->addError('duration', 'A plan already has this duration');
        } else {
            Category::create([
                'duration' => $this->duration,
                'interest' => $this->interest,
                'type' => 'regular'
            ]);
            $this->emit('saved');
            $this->reset(['duration', 'interest']);
            $this->emit('closeDrawer');
        }
    }

    public function render()
    {
        $this->regular = Category::whereType('regular')->get();
        $this->aplans = Savings::whereType('regular')->whereDate('expiry_date', '>', Carbon::today())
            ->when($this->asearch, function ($query) {
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->asearch . '%')
                        ->orWhereRelation('user', 'first_name', 'like', '%' . $this->asearch . '%')
                        ->orWhereRelation('user', 'last_name', 'like', '%' . $this->asearch . '%');
                });
            })
            ->when($this->asearch == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->aorderBy, $this->asortBy)
            ->paginate($this->aperPage);
            
        $this->eplans = Savings::whereType('regular')->whereDate('expiry_date', '<', Carbon::today())
            ->when($this->esearch, function ($query) {
                $query->where(function ($query) {
                    $query->Where('name', 'like', '%' . $this->esearch . '%')
                        ->orWhereRelation('user', 'first_name', 'like', '%' . $this->esearch . '%')
                        ->orWhereRelation('user', 'last_name', 'like', '%' . $this->esearch . '%');
                });
            })
            ->when($this->esearch == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->orderby($this->eorderBy, $this->esortBy)
            ->paginate($this->eperPage);

        return view('livewire.admin.savings.regular', [
            'regular' => $this->regular,
            'aplans' => $this->aplans,
            'eplans' => $this->eplans,
        ]);
    }
}
