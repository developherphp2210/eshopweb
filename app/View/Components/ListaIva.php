<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaIva extends Component
{
    /**
     * Create a new component instance.
     */

    public $aliquote = '';
    public function __construct($aliquote)
    {
        $this->aliquote = $aliquote;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anagrafica.lista_iva');
    }
}
