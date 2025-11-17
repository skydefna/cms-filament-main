<?php

namespace App\Filament\Widgets;

use App\Models\HitVisit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class VisitorCounterWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = null;

    protected static ?string $maxWidth = '100%';

    protected function getStats(): array
    {
        $model = Cache::remember('hit_visit', 3600, function () {
            return HitVisit::query()->where('name', 'hit_visit')->first();
        });
        $daily = visits($model)->period('day')->count();
        $monthly = visits($model)->period('month')->count();
        $yearly = visits($model)->period('year')->count();
        $total = visits($model)->count();

        return [
            Stat::make('Jumlah Kunjungan', $daily)
                ->description('Hari ini')
                ->color('success')
                ->descriptionIcon('heroicon-o-arrow-trending-up'),
            Stat::make('Jumlah Kunjungan', $monthly)
                ->description('Bulan ini')
                ->color('success')
                ->descriptionIcon('heroicon-o-arrow-trending-up'),
            Stat::make('Jumlah Kunjungan', $yearly)
                ->description('Tahun ini')
                ->color('success')
                ->descriptionIcon('heroicon-o-arrow-trending-up'),
            Stat::make('Jumlah Kunjungan', $total)
                ->description('Total Kunjungan')
                ->color('success')
                ->descriptionIcon('heroicon-o-arrow-trending-up'),
        ];
    }
}
