<?php

namespace App\View\Components;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected ThemeSetting $themeSetting,
        public array $menu
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.menu';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.menu';
        }

        return view($viewPath);
    }
}
