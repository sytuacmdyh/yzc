<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Share
 *
 * @property int $id
 * @property string $data
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $user_id
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereUserId($value)
 * @property int $is_public
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereIsPublic($value)
 * @property string|null $file_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Share whereFileName($value)
 */
class Share extends Model
{
    //
}
