<?php

namespace App\View\Components\Widgets;

use App\Settings\GeneralSetting;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AnnouncementWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected GeneralSetting $generalSetting, protected ThemeSetting $themeSetting) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.announcement-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.announcement-widget';
        }

        return view($viewPath, [
            'announcement' => $this->generalSetting->announcement,
        ]);
    }
}
