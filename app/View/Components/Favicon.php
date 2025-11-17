<?php

namespace App\View\Components;

use App\Settings\GeneralSetting;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Favicon extends Component
{
    public ?string $favicon = null;

    /**
     * Create a new component instance.
     */
    public function __construct(protected ThemeSetting $themeSetting, protected GeneralSetting $generalSetting)
    {
        if ($this->generalSetting->favicon) {
            $this->favicon = Storage::disk('public')->url($this->generalSetting->favicon);
        } else {
            $this->favicon = 'https://s3.tabalongkab.go.id/tabalong/tabalong_sm.png';
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.favicon';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.favicon';
        }

        return view($viewPath);
    }
}
