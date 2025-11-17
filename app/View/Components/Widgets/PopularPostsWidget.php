<?php

namespace App\View\Components\Widgets;

use App\Models\Post;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PopularPostsWidget extends Component
{
    protected string $type = 'popular';

    /**
     * Create a new component instance.
     */
    public function __construct(protected Post $post, protected ThemeSetting $themeSetting, public int $limit) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $posts = $this->post->getPopularPosts($this->limit);

        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.dokumen-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.dokumen-widget';
        }

        return view($viewPath);
    }
}
