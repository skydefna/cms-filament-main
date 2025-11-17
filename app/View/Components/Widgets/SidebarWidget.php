<?php

namespace App\View\Components\Widgets;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected ThemeSetting $themeSetting)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.sidebar-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.sidebar-widget';
        }

        return view($viewPath);
    }
}
