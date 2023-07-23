<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticlePage extends Component
{
    /**
     * Create a new component instance.
     * var array
     */
    
    public $articles = '';

    public function __construct($articoli)
    {
        $this->articles = $articoli;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.registry.article-page');
    }
}
