<?php

namespace App\View\Components;

use App\Models\Tickets;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaTickets extends Component
{
    /**
     * Create a new component instance.
     */
    public $listatickets = '';
    public function __construct()
    {
        $this->listatickets = Tickets::GetList();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.anagrafica.lista-tickets');
    }
}
