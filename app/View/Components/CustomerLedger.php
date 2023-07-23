<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CustomerLedger extends Component
{
    /**
     * Create a new component instance.
     */
    public $customer = '';  
    public $ledgers = '';  
 
    public function __construct($cliente,$ledger)
    {
        $this->customer = $cliente;
        $this->ledgers = $ledger;        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.registry.customer-ledger');
    }
}
