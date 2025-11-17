<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ManageRecords;

class ManageMenus extends ManageRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->mutateFormDataUsing(function (array $data) {
                    $data['parent_id'] = -1;

                    return $data;
                })
                ->after(function () {
                    // Dispatch an event to refresh the widget
                    $this->dispatch('refreshPostStatsWidget');
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MenuResource\Widgets\MenuWidget::class,
        ];
    }
}
