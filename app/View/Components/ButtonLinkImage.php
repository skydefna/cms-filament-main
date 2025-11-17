<?php

namespace App\View\Components;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonLinkImage extends Component
{
    /**
     * Create a new component instance
     *
     * @props(['imageIcon', 'label', 'href', 'rounded' => false])
     */
    public function __construct(
        public ThemeSetting $themeSetting,
        public string $imageIcon,
        public string $label,
        public string $href,
        public bool $center = false,
        public bool $rounded = false
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.button-link-image';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.button-link-image';
        }

        return view($viewPath);
    }
}
