<?php

namespace App\View\Components\Layouts;

use App\Settings\GeneralSetting;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class App extends Component
{
    protected GeneralSetting $generalSetting;

    protected ThemeSetting $themeSetting;

    /**
     * Create a new component instance.
     */
    public function __construct(GeneralSetting $generalSetting, ThemeSetting $themeSetting)
    {
        $this->generalSetting = $generalSetting;
        $this->themeSetting = $themeSetting;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.app';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.app';
        }

        return view($viewPath, [
            'generalSetting' => $this->generalSetting,
            'themeSetting' => $this->themeSetting,
        ]);
    }
}
