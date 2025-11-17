<?php

namespace App\View\Components;

use App\Models\SocialMedia;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialMediaCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected ThemeSetting $themeSetting, public SocialMedia $socialMedia)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.social-media-card';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.social-media-card';
        }

        return view($viewPath);
    }
}
