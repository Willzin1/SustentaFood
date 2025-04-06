<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $links;
    public $baseUrl;

    /**
     * Create a new component instance.
     */
    public function __construct(array $links, string $baseUrl)
    {
        $this->links = $links;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.pagination');
    }
}
