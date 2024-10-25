<?php

namespace App\View\Components;

use App\Models\FidelityCard;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaFidelityCard extends Component
{
    /**
     * Create a new component instance.
     */

    public $lista = [];
    public function __construct()
    {
        $this->lista = FidelityCard::GetListNoClient();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fidelity.listafidelitycard');
    }
}
