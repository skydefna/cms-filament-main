<?php

namespace App\View\Components\Widgets;

use App\Models\SocialMedia;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialMediasWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected ThemeSetting $themeSetting,
        protected SocialMedia $socialMedia,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.social-medias-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.social-medias-widget';
        }

        return view($viewPath, [
            'socialMedias' => $this->socialMedia->getSocialMedia(),
        ]);
    }
}
