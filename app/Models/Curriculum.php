<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Curriculum extends Model
{
    use HasFactory;
    protected $table = 'curriculums';

    public function getListByGrade_Id($id) {
        $curriculums = DB::table('curriculums')
            ->where('grade_id', '=' , $id)
            ->get();
        return $curriculums;
    }
    
    public function getListById($id) {
        $curriculum = DB::table('curriculums')
            ->where('id', '=' , $id)
            ->first();
        return $curriculum;
    }

    public function deliveryTimes() {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id');
    } 
}
