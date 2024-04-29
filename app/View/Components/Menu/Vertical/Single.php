<?php

namespace App\View\Components\Menu\Vertical;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Single extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $title = '',
        public $url = 'javascript:void(0)',
        public $active = false,
        public $icon = '',
        public $show = false,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.vertical.single');
    }
}
