<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $customer = '';    
 
    public function __construct($cliente)
    {
        $this->customer = $cliente;        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.registry.customer-form');
    }
}
