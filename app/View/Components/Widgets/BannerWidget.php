<?php

namespace App\View\Components\Widgets;

use App\Settings\GeneralSetting;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class BannerWidget extends Component
{
    protected GeneralSetting $GeneralSetting;

    protected ThemeSetting $themeSetting;

    /**
     * Create a new component instance.
     */
    public function __construct(GeneralSetting $GeneralSetting, ThemeSetting $themeSetting)
    {
        $this->GeneralSetting = $GeneralSetting;
        $this->themeSetting = $themeSetting;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $bannerImageUrl = Storage::disk('public')->url($this->GeneralSetting->banner);

        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.banner-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.banner-widget';
        }

        return view($viewPath, [
            'bannerImageUrl' => $bannerImageUrl,
        ]);
    }
}
