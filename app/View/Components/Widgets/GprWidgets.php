<?php

namespace App\View\Components\Widgets;

use App\Enums\CacheName;
use App\Jobs\GetGprData;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class GprWidgets extends Component
{
    public array $listGpr;

    protected ThemeSetting $themeSetting;

    /**
     * Create a new component instance.
     */
    public function __construct(ThemeSetting $themeSetting)
    {
        $this->themeSetting = $themeSetting;
        $this->listGpr = Cache::get(CacheName::GPR->name) ?? [];
        if (empty($this->listGpr)) {
            GetGprData::dispatch();
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.gpr-widgets';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.gpr-widgets';
        }

        return view($viewPath, [
            'listGpr' => $this->listGpr,
            'tema' => $this->themeSetting->theme,
        ]);
    }
}
