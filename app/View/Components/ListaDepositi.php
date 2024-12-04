<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaDepositi extends Component
{
    /**
     * Create a new component instance.
     */

    public $listadepositi = '';
    public function __construct($listadepositi)
    {
        $this->listadepositi = $listadepositi;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.barriera.lista_depositi');
    }
}
