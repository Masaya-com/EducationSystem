<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $table = 'delivery_times';

    protected $fillable = [
        'curriculum_id', 'created_id', 'update_id'
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }

    public static function canBeWatchedNow($curriculumId)
    {
    $now = now();

    return self::where('curriculum_id', $curriculumId)
        ->where('delivery_from', '<=', $now)
        ->where('delivery_to', '>=', $now)
        ->exists();
    }
}
