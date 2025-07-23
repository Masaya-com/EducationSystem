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
}
