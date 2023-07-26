<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideNavFidelity extends Component
{
    /**
     * Create a new component instance.
    * @var array
     */

    public $user = '';
    public $cards = '';

    public function __construct($user,$cards)
    {
        $this->user = $user;
        $this->cards = $cards;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.fidelity.side-nav-fidelity');
    }
}
