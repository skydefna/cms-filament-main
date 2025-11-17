<?php

namespace App\View\Components;

use App\Settings\GeneralSetting;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class AppLogo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        protected ThemeSetting $themeSetting,
        protected GeneralSetting $generalSetting,
        public string $size = 'default'
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.atoms.app-logo';
        $primaryLogo = 'https://s3.tabalongkab.go.id/tabalong/tabalong_sm.png';
        $secondaryLogo = null;
        if ($this->generalSetting->primary_logo) {
            $primaryLogo = Storage::disk('public')->url($this->generalSetting->primary_logo);
        }
        if ($this->generalSetting->secondary_logo) {
            $secondaryLogo = Storage::disk('public')->url($this->generalSetting->secondary_logo);
        }
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.atoms.app-logo';
        }

        return view($viewPath, [
            'primary_logo' => $primaryLogo,
            'secondary_logo' => $secondaryLogo,
            'size' => $this->size,
        ]);
    }
}
