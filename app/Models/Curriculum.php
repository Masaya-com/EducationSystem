<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Curriculum extends Model
{
    protected $table = 'curriculums';

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'thumbnail',  
    ];


    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    }
}

