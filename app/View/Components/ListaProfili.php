<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaProfili extends Component
{
    /**
     * Create a new component instance.
     */

    public $listaprofili = '';
    public function __construct($listaprofili)
    {
        $this->listaprofili = $listaprofili;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.anagrafica.lista_profili');
    }
}
