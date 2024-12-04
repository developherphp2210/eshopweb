<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PaginaReparti extends Component
{
    /**
     * Create a new component instance.
     */

    public $reparti = '';
    public function __construct($reparti)
    {
        $this->reparti = $reparti;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.anagrafica.lista_reparti');
    }
}
