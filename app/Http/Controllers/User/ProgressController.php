<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Grade;   
use App\Models\Curriculum;

class ProgressController extends Controller
{
    public function showProgress()
    {
        $user = auth()->user();
        $grades = Grade::all();
        $curriculums = Curriculum::all();

        return view('user.curriculum_progress', compact('user', 'grades', 'curriculums'));
    }

}
