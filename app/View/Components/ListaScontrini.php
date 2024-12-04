<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaScontrini extends Component
{
    /**
     * Create a new component instance.
     */

    public $lista = '';
    public function __construct($lista)
    {
        $this->lista = $lista;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fidelity.lista-scontrini');
    }
}
