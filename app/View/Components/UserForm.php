<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserForm extends Component
{
    /**
     * Create a new component instance.
    * @var array
     */

    public $myuser = '';

    public function __construct($myus)
     {
        $this->myuser = $myus;
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.user-form');
    }
}
