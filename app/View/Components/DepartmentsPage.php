<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DepartmentsPage extends Component
{
    /**
     * Create a new component instance.
     * 
     * var collect
     */

    public $departments = '';
    
    public function __construct($reparti)
    {
        $this->departments = $reparti;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.registry.departments-page');
    }
}
