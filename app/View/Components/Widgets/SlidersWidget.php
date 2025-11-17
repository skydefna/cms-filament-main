<?php

namespace App\View\Components\Widgets;

use App\Models\Slider;
use App\Settings\GeneralSetting;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SlidersWidget extends Component
{
    public Slider $slider;

    protected ThemeSetting $themeSetting;

    protected GeneralSetting $generalSetting;

    /**
     * Create a new component instance.
     */
    public function __construct(Slider $slider, ThemeSetting $themeSetting, GeneralSetting $generalSetting)
    {
        $this->slider = $slider;
        $this->themeSetting = $themeSetting;
        $this->generalSetting = $generalSetting;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.sliders-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.sliders-widget';
        }

        return view($viewPath, [
            'sliders' => $this->slider->getCachedSlider(),
            'aspectRatio' => $this->generalSetting->slider_height / $this->generalSetting->slider_width,
        ]);
    }
}
