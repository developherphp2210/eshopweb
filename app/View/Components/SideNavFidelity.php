<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideNavFidelity extends Component
{
    /**
     * Create a new component instance.
    * @var array
     */
    
    public $index = '';
    public $cards = '';
    public function __construct($index)
    {        
        $this->index = $index;
        $this->cards = [];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fidelity.main.side-nav');
    }
}
