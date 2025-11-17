<?php

namespace App\View\Components\Widgets;

use App\Models\HitVisit;
use App\Settings\ThemeSetting;
use Awssat\Visits\Exceptions\InvalidPeriod;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class VisitorWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(protected ThemeSetting $themeSetting) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @throws InvalidPeriod
     */
    public function render(): View|Closure|string
    {
        $model = Cache::remember('hit_visit', 3600, function () {
            return HitVisit::query()->where('name', 'hit_visit')->first();
        });
        $daily = visits($model)->period('day')->count();
        $monthly = visits($model)->period('month')->count();
        $yearly = visits($model)->period('year')->count();
        $total = visits($model)->count();

        $viewPath = 'themes.'.$this->themeSetting->theme.'.widgets.visitor-widget';
        if (! view()->exists($viewPath)) {
            $viewPath = 'themes.default.widgets.visitor-widget';
        }

        return view($viewPath, compact('daily', 'monthly', 'yearly', 'total'));
    }
}
