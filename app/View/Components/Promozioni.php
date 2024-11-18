<?php

namespace App\View\Components;

use App\Models\Depositi;
use App\Models\Promo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Promozioni extends Component
{
    /**
     * Create a new component instance.
     */

    public $promozioni = ''; 
    public $depositi = '';
    public function __construct()
    {
        $this->promozioni = Promo::GetList();
        $this->depositi = Depositi::GetList();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fidelity.promozioni');
    }
}
