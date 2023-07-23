<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VatsPage extends Component
{
    /**
     * Create a new component instance.
     * var array
     */
    public $vats = '';
    
    public function __construct($iva)
    {
        $this->vats = $iva;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.registry.vats-page');
    }
}
