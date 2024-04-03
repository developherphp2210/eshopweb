<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaCasse extends Component
{
    /**
     * Create a new component instance.
     */
    public $listacasse = '';
    public function __construct($listacasse)
    {
        $this->listacasse = $listacasse;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.barriera.lista_casse');
    }
}
