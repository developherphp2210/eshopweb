<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReceiptList extends Component
{
    /**
     * Create a new component instance.
     */

    public $user = '';
    public $transactions = '';

    public function __construct($user,$transactions)
    {
        $this->user = $user;
        $this->transactions = $transactions;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.receipt-list');
    }
}
