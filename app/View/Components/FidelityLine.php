<?php

namespace App\View\Components;

use App\Models\LineaFidelity;
use App\Models\TListino;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FidelityLine extends Component
{
    /**
     * Create a new component instance.
     */
    public $lineafidelity = [];  
    public $listino = [];
    public function __construct()
    {      
        $this->lineafidelity = LineaFidelity::GetList();
        $this->listino = TListino::GetList();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fidelity.lineafidelity');
    }
}
