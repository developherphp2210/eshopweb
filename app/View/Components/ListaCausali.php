<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaCausali extends Component
{
    /**
     * Create a new component instance.
     */

    public $listacausali = '';
    public function __construct($listacausali)
    {
        $this->listacausali = $listacausali;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.anagrafica.lista_causali');
    }
}
