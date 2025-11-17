<?php

namespace App\View\Components;

use App\Settings\GeneralSetting;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AppName extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected ThemeSetting $themeSetting,
        protected GeneralSetting $generalSetting,
        public string $variant = 'default'
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.app-name';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.app-name';
        }

        return view($viewPath, [
            'siteName' => $this->generalSetting->site_name,
            'siteShortName' => $this->generalSetting->site_short_name,
        ]);
    }
}
