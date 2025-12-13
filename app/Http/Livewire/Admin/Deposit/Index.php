<?php

namespace App\Http\Livewire\Admin\Deposit;

use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Jobs\SendEmail;
use App\Models\Transactions;

class Index extends Component
{
    public $perPage = 200;
    public $admin;
    public $set;
    public $search = "";
    public $base;
    public $type;
    public $exportType;
    public $exportAs;
    public $date;
    public $sortBy = "created_at";
    public $orderBy = "desc";

    protected $listeners = ['saved' => '$refresh'];

    public function loadMore()
    {
        $this->perPage = $this->perPage + 10;
        $this->emit('drawer');
    }

    public function save($formData)
    {
        Validator::make($formData, ['exportType' => 'required', 'exportAs' => 'required'], ['exportType.required' => "Please select a file format"])->validate();
        if ($this->pages()->count() > 0) {
            $date = explode('-', $this->date);
            if ($formData['exportAs'] == "download") {
                return Excel::download(new TransactionExport($this->pages()->whereBetween('created_at', [Carbon::create($date[0])->toDateString(), Carbon::create($date[1])->addDays(1)->toDateString()])), ($formData['exportType'] == 'csv') ? 'transaction.csv' : 'transaction.xlsx');
                return $this->emit('success', 'Transaction Statement complete');
            } else {
                $filename = Str::random(8) . ($formData['exportType'] == 'csv') ? '.csv' : '.xlsx';
                Excel::store(new TransactionExport($this->pages()->whereBetween('created_at', [Carbon::create($date[0])->toDateString(), Carbon::create($date[1])->addDays(1)->toDateString()])), $filename);
                dispatch(new SendEmail($this->set->email, $this->set->site_name, 'Transaction Statement', 'Transaction Statement between ' . $this->date, storage_path('app/' . $filename), null, 0));
                return $this->emit('success', 'Transaction Statement sent to your email');
            }
        } else {
            return $this->emit('alert', __('No transaction to export!'));
        }
    }

    public function render()
    {
        $page = $this->pages();
        return view('livewire.admin.deposit.index', [
            'transactions' => $page->paginate($this->perPage),
            'first' => ($page->count() > 0) ? date("m/d/Y", strtotime($page->reorder()->oldest()->first()->created_at)) : date("m/d/Y", strtotime(Carbon::now())),
            'last' => ($page->count() > 0) ? date("m/d/Y", strtotime($page->reorder()->latest()->first()->created_at)) : date("m/d/Y", strtotime(Carbon::now())),
        ]);
    }

    protected function pages()
    {
        return Transactions::with(['user', 'business'])->whereStatus($this->base)
            ->whereType('deposit')->orWhere('type', 'bank_transfer')->whereStatus($this->base)
            ->when($this->search, function ($query) {
                $this->emit('drawer');
                $query->where(function ($query) {
                    $query->where('amount', 'like', '%' . $this->search . '%')
                        ->orWhere('charge', 'like', '%' . $this->search . '%')
                        ->orWhere('ref_id', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%')
                        ->orWhere('routing_code', 'like', '%' . $this->search . '%')
                        ->orWhere('acct_no', 'like', '%' . $this->search . '%')
                        ->orWhere('acct_name', 'like', '%' . $this->search . '%')
                        ->orWhere('bank_reference', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'first_name', 'like', '%' . $this->search . '%')
                        ->orWhereRelation('user', 'last_name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->search == null, function ($query) {
                $this->emit('searchdrawer');
            })
            ->when(($this->date != null), function ($query) {
                $from = Carbon::create(explode('-', $this->date)[0]);
                $to = Carbon::create(explode('-', $this->date)[1])->addDay(1);
                if ($from != $to) {
                    return $query->whereBetween('created_at', [$from, $to]);
                } else {
                    return $query->where('created_at', '>=', $from);
                }
            }, function ($query) {
                return $query->where('created_at', '>', Carbon::now()->subDays(30)->endOfDay());
            })
            ->when(($this->type != null), function ($query) {
                return $query->whereType($this->type);
            })
            ->orderby($this->sortBy, $this->orderBy);
    }
}
