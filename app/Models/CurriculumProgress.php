<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
