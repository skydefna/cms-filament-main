<?php

namespace App\View\Components;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Heading extends Component
{
    /**
     * Create a new component instance.
     *
     * @props(['label', 'border' => false])
     */
    public function __construct(public ThemeSetting $themeSetting, public string $label, public $border = false, public $size = 'md')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.heading';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.heading';
        }

        return view($viewPath);
    }
}
