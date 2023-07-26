<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SettingPage extends Component
{
    /**
     * Create a new component instance.
     */

    public $setting = '';
    public $notification = '';

    public function __construct($setting,$notification)
    {
        $this->setting = $setting;
        $this->notification = $notification;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.setting-page');
    }
}
