<?php

namespace App\View\Components;

use App\Models\YoutubeVideo;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class YoutubeCard extends Component
{
    /**
     * Create a new component instance.
     *
     * @props(['youtubeVideo', 'tema'])
     */
    public function __construct(
        protected ThemeSetting $themeSetting,
        public YoutubeVideo $youtubeVideo,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.youtube-card';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.youtube-card';
        }

        return view($viewPath);
    }
}
