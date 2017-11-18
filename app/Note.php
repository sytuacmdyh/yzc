<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Note
 *
 * @property int $id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $title
 * @property string|null $content
 * @property string|null $type
 * @property int $user_id
 * @property string $status
 * @property \Carbon\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Note onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Note whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Note withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Note withoutTrashed()
 * @mixin \Eloquent
 */
class Note extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
