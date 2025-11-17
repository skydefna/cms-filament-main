<?php

namespace App\Filament\Resources\MenuResource\Widgets;

use App\Models\Menu;
use SolutionForest\FilamentTree\Widgets\Tree as BaseWidget;

class MenuWidget extends BaseWidget
{
    protected $listeners = [
        'refreshMenuWidget' => '$refresh',
    ];

    protected static string $model = Menu::class;

    protected static int $maxDepth = 5;

    protected ?string $treeTitle = 'Menu Builder';

    protected bool $enableTreeTitle = true;

    protected function hasDeleteAction(): bool
    {
        return true;
    }
}
