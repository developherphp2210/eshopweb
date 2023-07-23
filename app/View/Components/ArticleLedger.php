<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleLedger extends Component
{
    /**
     * Create a new component instance.
     */
    public $articles = '';
    public $ledgers = '';
 
    public function __construct($articolo,$ledger)
    {
        $this->articles = $articolo;
        $this->ledgers = $ledger;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.registry.article-ledger');
    }
}
