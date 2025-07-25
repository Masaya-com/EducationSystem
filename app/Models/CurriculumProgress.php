<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 'curriculum_id', 'clear_flg'
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }

    public static function markAsCleared($userId, $curriculumId)
    {
    DB::transaction(function () use ($userId, $curriculumId) {
        self::updateOrCreate(
            ['users_id' => $userId, 'curriculums_id' => $curriculumId],
            ['clear_flg' => true]
        );
    });
    }
}
