<?php

namespace App\View\Components\Widgets;

use App\Models\YoutubeVideo;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class YoutubeVideosWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected YoutubeVideo $youtubeVideo,
        protected ThemeSetting $themeSetting,
        public int $limit = 4,
        public int $perPage = 3
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $youtubeVideos = $this->youtubeVideo->getLatestVideos($this->limit);

        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.youtube-videos-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.youtube-videos-widget';
        }

        return view($viewPath, [
            'youtubeVideos' => $youtubeVideos,
        ]);
    }
}
