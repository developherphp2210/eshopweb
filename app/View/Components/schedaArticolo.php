<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class schedaArticolo extends Component
{
    /**
     * Create a new component instance.
     */

    public $listaArticolo = '';
    public function __construct($listaArticolo)
    {
        $this->listaArticolo = $listaArticolo;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.anagrafica.scheda-articolo');
    }
}
