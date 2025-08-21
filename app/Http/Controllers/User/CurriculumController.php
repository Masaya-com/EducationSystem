<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use Carbon\Carbon;

class CurriculumController extends Controller
{

    public function index()
{

    $curriculums = \App\Models\Curriculum::with('deliveryTimes')->get();

    return view('user.auth.curriculum_list', compact('thumbnail', 'curriculums'));
}
    /**
     * 学年別カリキュラムとスケジュール表示
     */
    public function showCurriculumList($gradeId = null, $month = null)
    {

    $grades = Grade::all();
    $currentGrade = $gradeId ? Grade::find($gradeId) : null;
    $thumbnail = 'banners/Zx7H62xnAn1EffqFKfuYZvAdf3o0fT8gBUH1U0E0.jpg'; // 1枚目を取得
    $curriculums = $currentGrade
        ? Curriculum::where('grade_id', $currentGrade->id)->get()
        : Curriculum::all();
        
    // 月の処理
    $currentMonth = $month ? Carbon::createFromFormat('Y-m', $month) : Carbon::now();

    $deliverySchedules = DeliveryTime::whereIn('curriculums_id', $curriculums->pluck('id'))
        ->whereYear('delivery_from', $currentMonth->year)
        ->whereMonth('delivery_from', $currentMonth->month)
        ->orderBy('delivery_from')
        ->get();

    return view('user.auth.curriculum_list', compact(
        'grades', 'curriculums', 'currentGrade', 'deliverySchedules', 'currentMonth','thumbnail'
    ));

    
        
}
}