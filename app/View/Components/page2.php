<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class page2 extends Component
{
    /**
     * Create a new component instance.
     */
    public $user = '';
    public $notification = '';

    public function __construct($user,$notification)
    {
        $this->user = $user;
        $this->notification = $notification;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.page2');
    }
}
