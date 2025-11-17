<?php

namespace App\Models;

use App\Enums\CacheName;
use App\Enums\MenuType;
use App\Observers\MenuObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use SolutionForest\FilamentTree\Concern\ModelTree;

/**
 * @property int $id
 * @property int $parent_id
 * @property string|null $page_id
 * @property string|null $url
 * @property string|null $path
 * @property int $order
 * @property string $title
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Menu> $children
 * @property-read int|null $children_count
 * @property-read \App\Models\Page|null $page
 * @property-read Menu|null $parent
 *
 * @method static Builder<static>|Menu dropdown()
 * @method static \Database\Factories\MenuFactory factory($count = null, $state = [])
 * @method static Builder<static>|Menu getMenuTree()
 * @method static Builder<static>|Menu isRoot()
 * @method static Builder<static>|Menu newModelQuery()
 * @method static Builder<static>|Menu newQuery()
 * @method static Builder<static>|Menu ordered(string $direction = 'asc')
 * @method static Builder<static>|Menu query()
 * @method static Builder<static>|Menu whereCreatedAt($value)
 * @method static Builder<static>|Menu whereId($value)
 * @method static Builder<static>|Menu whereOrder($value)
 * @method static Builder<static>|Menu wherePageId($value)
 * @method static Builder<static>|Menu whereParentId($value)
 * @method static Builder<static>|Menu wherePath($value)
 * @method static Builder<static>|Menu whereTitle($value)
 * @method static Builder<static>|Menu whereType($value)
 * @method static Builder<static>|Menu whereUpdatedAt($value)
 * @method static Builder<static>|Menu whereUrl($value)
 *
 * @mixin \Eloquent
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
#[ObservedBy([MenuObserver::class])]
class Menu extends Model
{
    use HasFactory, ModelTree;

    protected $casts = [
        'parent_id' => 'int',
    ];

    protected $table = 'menu';

    public function scopeDropdown(Builder $query)
    {
        return $query->where('type', MenuType::DROPDOWN->value);
    }

    public function page(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function scopeGetMenuTree(): array
    {
        $menu = self::query()
            ->with('page')
            ->orderBy('order')
            ->get()
            ->toArray();

        return $this->menuBuilder($menu);
    }

    public function menuBuilder($elements, $parentId = -1): array
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->menuBuilder($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                    $element['type'] = 'dropdown';
                } else {
                    $element['children'] = [];
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }

    public function getListMenu()
    {
        return Cache::rememberForever(CacheName::MENU->name, function () {
            return $this->scopeGetMenuTree();
        });
    }
}
