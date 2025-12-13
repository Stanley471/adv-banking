<?php

namespace App\Http\Livewire\Admin\Invest;

use Livewire\Component;
use App\Models\Category;
use App\Models\Plans;

class Header extends Component
{

    private $project_plans;
    private $mutual_plans;
    private $category;
    private $categoryAll;
    public $type;
    public $admin;


    protected $listeners = ['saved' => '$refresh'];

    public function render()
    {
        $this->project_plans = Plans::whereType('project')->get()->count();
        $this->mutual_plans = Plans::whereType('mutual')->get()->count();
        $this->category = Category::whereType('invest')->count();
        return view('livewire.admin.invest.header', [
            'project_plans' => $this->project_plans,
            'mutual_plans' => $this->mutual_plans,
            'category' => $this->category,
            'categoryAll' => $this->categoryAll,
        ]);
    }
}
