<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaArticoli extends Component
{
    /**
     * Create a new component instance.
     */

    public $articoli = '';
    public function __construct($articoli)
    {
        $this->articoli = $articoli;    
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anagrafica.lista_articoli');
    }
}
