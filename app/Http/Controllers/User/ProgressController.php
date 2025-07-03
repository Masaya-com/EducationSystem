<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Grade;   
use App\Models\Curriculum;
use App\Http\Controllers\Controller;

class ProgressController extends Controller
{
    public function showProgress()
    {
        $user = auth()->user();
        $grades = Grade::all();
        $curriculums = Curriculum::all();
        $gradesList = config('grades.grades_list');

        $progressCells = [];
        foreach (config('grades.grades_list') as $i => $gradeName) {
            $cell = [
                'grade_name' => $gradeName,
                'curriculums' => []
            ];
            foreach (Curriculum::where('grade_id', $i + 1)->get() as $curriculum) {
                $cell['curriculums'][] = [
                    'id' => $curriculum->id,
                    'title' => $curriculum->title,
                    'is_completed' => optional($user->curriculumProgress->where('curriculum_id', $curriculum->id)->first())->is_completed,
                ];
            }
            $progressCells[] = $cell;
        }
        $progressRows = array_chunk(array_pad($progressCells, 12, null), 3);
        return view('user.layouts.curriculum_progress', compact('user', 'progressRows'));
    }

}
