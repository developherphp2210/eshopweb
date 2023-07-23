<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UsersList extends Component
{
    /**
     * Create a new component instance.
    * @var array
    */

    public $userslist = '';

    public function __construct($list)
    {
        $this->userslist = $list;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.users-list');
    }
}
