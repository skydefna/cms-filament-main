<?php

namespace App\View\Components\Widgets;

use App\Settings\GeneralSetting;
use App\Settings\ThemeSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrganizationChart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(        
        protected ThemeSetting $themeSetting,
        protected GeneralSetting $generalSetting,
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $nodeWidth = $this->generalSetting->node_width;
        $nodeHeight = $this->generalSetting->node_height;

        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.organization-chart';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.organization-chart';
        }

        return view($viewPath, [
            'nestedList' => $nestedList[0] ?? null,
            'height' => $maxDepth * $nodeHeight,
            'nodeWidth' => $nodeWidth,
            'nodeHeight' => $nodeHeight,
        ]);
    }
}
