<?php

namespace App\View\Components\Widgets;

use App\Models\BannerLink;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BannerLinksWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected BannerLink $bannerLink, protected ThemeSetting $themeSetting) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.banner-links-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.banner-links-widget';
        }

        return view($viewPath, [
            'bannerLinks' => $this->bannerLink->getBannerLinks(),
        ]);
    }
}
