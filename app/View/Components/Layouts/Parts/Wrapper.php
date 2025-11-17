<?php

namespace App\View\Components\Layouts\Parts;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Wrapper extends Component
{
    protected ThemeSetting $themeSetting;

    /**
     * Create a new component instance.
     */
    public function __construct(ThemeSetting $themeSetting)
    {
        $this->themeSetting = $themeSetting;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.wrapper';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.wrapper';
        }

        return view($viewPath, [
            'tema' => $this->themeSetting->theme,
        ]);
    }
}
