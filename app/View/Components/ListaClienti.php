<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaClienti extends Component
{
    /**
     * Create a new component instance.
     */

    public $clienti = '';
    public function __construct($clienti)
    {
        $this->clienti = $clienti;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anagrafica.lista_clienti');
    }
}
