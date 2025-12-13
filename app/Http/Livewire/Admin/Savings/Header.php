<?php

namespace App\Http\Livewire\Admin\Savings;

use Livewire\Component;
use App\Models\Category;

class Header extends Component
{

    private $category;
    private $circle;
    public $type;
    public $admin;


    protected $listeners = ['saved' => '$refresh'];

    public function render()
    {
        $this->category = Category::whereType('circle_category')->count();
        $this->circle = Category::whereType('circle')->count();
        
        return view('livewire.admin.savings.header', [
            'circle' => $this->circle,
            'category' => $this->category,
        ]);
    }
}
