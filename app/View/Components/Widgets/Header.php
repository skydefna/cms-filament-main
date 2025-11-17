<?php

namespace App\View\Components\Widgets;

use App\Models\Menu;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    protected Menu $menu;

    protected ThemeSetting $themeSetting;

    /**
     * Create a new component instance.
     */
    public function __construct(Menu $menu, ThemeSetting $themeSetting)
    {
        $this->menu = $menu;
        $this->themeSetting = $themeSetting;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.header';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.header';
        }

        return view($viewPath, [
            'listMenu' => $this->menu->getListMenu(),
        ]);
    }
}
