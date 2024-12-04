<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaFidelity extends Component
{
    /**
     * Create a new component instance.
     */

    public $listafidelity = '';
    public function __construct($listafidelity)
    {
        $this->listafidelity = $listafidelity;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fidelity.lista-fidelity');
    }
}
