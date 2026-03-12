<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nama
 * @property string|null $nilai
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengaturan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengaturan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengaturan query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengaturan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengaturan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengaturan whereNama($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengaturan whereNilai($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Pengaturan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Pengaturan extends Model
{
    protected $table = 'pengaturan';

    protected $fillable = ['nama','nilai'];
}
