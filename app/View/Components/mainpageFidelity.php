<?php

namespace App\View\Components;

use App\Models\FidelityCard;
use App\Models\VolantinoPdf;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class mainpageFidelity extends Component
{
    /**
     * Create a new component instance.
     */
    public $lista = [];
    public function __construct()
    {
        $this->lista['Fidelity'] =  FidelityCard::GetListUtenti(session('user')->id);        
        $this->lista['pdf'] = VolantinoPdf::GetList();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fidelity.mainpage-fidelity');
    }
}
