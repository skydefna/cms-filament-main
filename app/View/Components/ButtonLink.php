<?php

namespace App\View\Components;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ButtonLink extends Component
{
    /**
     * Create a new component instance.
     *
     * @props(['href', 'label', 'icon' => null, 'target' => '_self', 'rounded' => false])
     */
    public function __construct(
        protected ThemeSetting $themeSetting,
        public string $href,
        public string $label,
        public ?string $icon = null,
        public string $target = '_self',
        public bool $rounded = false,
        public ?string $variant = 'default',
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.button-link';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.button-link';
        }

        return view($viewPath);
    }
}
