<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavBarAdmin extends Component
{
    /**
     * Create a new component instance.
     * @var array
     */

    public $user = '';

    public function __construct($us)
    {
        $this->user = $us;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.nav-bar-admin');
    }
}
