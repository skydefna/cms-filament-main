<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HitVisit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HitVisit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HitVisit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HitVisit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HitVisit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HitVisit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|HitVisit whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 *
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class HitVisit extends Model
{
    protected $table = 'hit_visits';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public function vzt(): \Awssat\Visits\Visits
    {
        return visits($this);
    }
}
