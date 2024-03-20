<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaSconti extends Component
{
    /**
     * Create a new component instance.
     */

    public $listasconti = '';
    public function __construct($listasconti)
    {
        $this->listasconti = $listasconti;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anagrafica.lista_sconti');
    }
}
