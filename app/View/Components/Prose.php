<?php

namespace App\View\Components;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Prose extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public ThemeSetting $themeSetting)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.prose';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.prose';
        }

        return view($viewPath);
    }
}
