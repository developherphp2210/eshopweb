<?php

namespace App\View\Components;

use App\Models\Depositi;
use App\Models\VolantinoPdf;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListaVolantiniPdf extends Component
{
    /**
     * Create a new component instance.
     */

    public $lista = '';
    public $depositi = '';
    public function __construct()
    {
        $this->lista = VolantinoPdf::GetList();
        $this->depositi = Depositi::GetList();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.volantini.lista-volantini-pdf');
    }
}
