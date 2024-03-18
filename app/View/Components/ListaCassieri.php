<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaCassieri extends Component
{
    /**
     * Create a new component instance.
     */

    public $listacassieri = '';
    public function __construct($listacassieri)
    {
        $this->listacassieri = $listacassieri;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anagrafica.lista_cassieri');
    }
}
