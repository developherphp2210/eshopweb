<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainPageDashboard extends Component
{
    /**
     * Create a new component instance.
     */
    public $user = '';
    public $total = '';

    public function __construct($user,$total)
    {
        $this->user = $user;
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main-page-dashboard');
    }
}
