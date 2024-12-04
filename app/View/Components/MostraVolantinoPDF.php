<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MostraVolantinoPDF extends Component
{
    /**
     * Create a new component instance.
     */

    public $volantino = '';
    public function __construct($volantino)
    {
        $this->volantino = $volantino;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.volantini.mostra-volantinopdf');
    }
}
