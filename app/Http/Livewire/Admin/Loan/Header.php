<?php

namespace App\Http\Livewire\Admin\Loan;

use Livewire\Component;
use App\Models\LoanPlans;
use App\Models\LoanApplicants;
use App\Models\Category;

class Header extends Component
{

    private $loanplans;
    private $bnplplans;
    private $category;
    private $pendingApplicants;
    private $runningApplicants;
    private $defaultApplicants;
    private $completeApplicants;
    public $type;
    public $admin;


    protected $listeners = ['saved' => '$refresh'];

    public function render()
    {
        $this->loanplans = LoanPlans::whereType('loan')->count();
        $this->bnplplans = LoanPlans::whereType('product')->count();
        $this->category = Category::whereType('product')->count();
        $this->pendingApplicants = LoanApplicants::whereStatus('pending')->get()->count();
        $this->runningApplicants = LoanApplicants::whereStatus('running')->whereDefaulter(0)->get()->count();
        $this->defaultApplicants = LoanApplicants::whereStatus('running')->whereDefaulter(1)->get()->count();
        $this->completeApplicants = LoanApplicants::whereStatus('paid')->whereDefaulter(0)->get()->count();
        
        return view('livewire.admin.loan.header', [
            'loanplans' => $this->loanplans,
            'bnplplans' => $this->bnplplans,
            'pendingApplicants' => $this->pendingApplicants,
            'runningApplicants' => $this->runningApplicants,
            'defaultApplicants' => $this->defaultApplicants,
            'completeApplicants' => $this->completeApplicants,
            'category' => $this->category,
        ]);
    }
}
