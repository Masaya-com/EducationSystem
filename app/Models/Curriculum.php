<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curriculum extends Model
{
    protected $table = 'curriculums'; 
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'video_url', 'grade_id', 'always_delivery_flg'
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
