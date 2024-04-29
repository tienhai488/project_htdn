<?php

namespace App\View\Components\Menu\Vertical;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropDown extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $id = '',
        public $title = '',
        public $active = false,
        public $dropDownActive = false,
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
        return view('components.menu.vertical.drop-down');
    }
}
