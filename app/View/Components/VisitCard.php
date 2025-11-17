<?php

namespace App\View\Components;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VisitCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected ThemeSetting $themeSetting,
        public string $label,
        public string $value,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.visit-card';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.visit-card';
        }

        return view($viewPath);
    }
}
