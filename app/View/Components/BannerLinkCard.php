<?php

namespace App\View\Components;

use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BannerLinkCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected ThemeSetting $themeSetting, public \App\Models\BannerLink $bannerLink)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.banner-link-card';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.banner-link-card';
        }

        return view($viewPath);
    }
}
