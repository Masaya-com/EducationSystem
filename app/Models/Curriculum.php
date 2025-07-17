<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CurriculumRequest;

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

    public static function addform(CurriculumRequest $request,$img_path) {
        $curriculum = new Curriculum();
        $curriculum->grade_id = $request->grade_id;
        $curriculum->title = $request->title;
        $curriculum->video_url = $request->video_url;
        $curriculum->description = $request->description;
        $curriculum->alway_delivery_flg = $request->boolean('alway_delivery_flg');
        $curriculum -> thumbnail = $img_path;

        return $curriculum;
    }

    public static function editform(Curriculum $curriculum,CurriculumRequest $request,$img_path) {
        $id = $request -> input('id');
        $curriculum->grade_id = $request->grade_id;
        $curriculum->title = $request->title;
        $curriculum->video_url = $request->video_url;
        $curriculum->description = $request->description;
        $curriculum->alway_delivery_flg = $request->boolean('alway_delivery_flg');
        $curriculum -> thumbnail = $img_path;

        return $curriculum;
    }

}
