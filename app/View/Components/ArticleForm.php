<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleForm extends Component
{
    /**
     * Create a new component instance.
     */
    
    public $articles = '';
    public $codeans = '';
 
    public function __construct($articolo,$codean)
    {
        $this->articles = $articolo;
        $this->codeans = $codean;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.registry.article-form');
    }
}
