<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\PostsChartMonthly;
use App\Filament\Widgets\SeeWebsiteWidget;
use App\Filament\Widgets\VisitorCounterWidget;
use Filament\Widgets\AccountWidget;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?int $navigationSort = 1;

    protected function getHeaderWidgets(): array
    {
        return [
            AccountWidget::class,
            SeeWebsiteWidget::class,
        ];
    }

    public function getWidgets(): array
    {
        return [
            VisitorCounterWidget::class,            
        ];
    }
}
