<?php

namespace App\View\Components\Widgets;

use App\Settings\generalSetting;
use App\Settings\LocationSetting;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddressWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected LocationSetting $locationSetting, protected generalSetting $generalSetting, protected ThemeSetting $themeSetting) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.address-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.address-widget';
        }

        return view($viewPath, [
            'locationSetting' => $this->locationSetting,
            'generalSetting' => $this->generalSetting,
        ]);
    }
}
