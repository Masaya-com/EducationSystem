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
    public function showCurriculumList(Request $request, $gradeId = null, $month = null)
{
    $grades = Grade::all();
    $currentGrade = $gradeId ? Grade::find($gradeId) : null;

    // curriculumsを取得（thumbnail込み）
    $curriculums = $currentGrade
        ? Curriculum::with('deliveryTimes')->where('grade_id', $currentGrade->id)->get()
        : Curriculum::with('deliveryTimes')->get();

    // 月処理
    $currentMonth = $month
        ? Carbon::createFromFormat('Y-m', $month)
        : Carbon::now();

    // DeliverySchedulesをモデル経由で取得
    $deliverySchedules = DeliveryTime::whereIn('curriculums_id', $curriculums->pluck('id'))
        ->forMonth($currentMonth->year, $currentMonth->month)
        ->get();

    return view('user.curriculum_list', compact(
        'grades',
        'curriculums',
        'currentGrade',
        'deliverySchedules',
        'currentMonth'
    ));
}
}
