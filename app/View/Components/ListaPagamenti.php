<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaPagamenti extends Component
{
    /**
     * Create a new component instance.
     */

    public $listapagamenti = '';
    public function __construct($listapagamenti)
    {
        $this->listapagamenti = $listapagamenti;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.anagrafica.lista_pagamenti');
    }
}
