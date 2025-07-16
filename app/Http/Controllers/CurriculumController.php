<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CurriculumRequest;
use App\Models\Grade;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use Illuminate\Support\Facades\DB;

class CurriculumController extends Controller
{
    public function showCurriculumList(Request $request){
        if ($request->ajax()) {
            $topgrade_id = $request->input('grade_id', 1);

            $topgrade = Grade::find($topgrade_id);
            $othergrades = Grade::where('id', '!=', $topgrade_id)->get();

            $curriculums = Curriculum::with('deliveryTimes')
                ->where('grade_id', $topgrade_id)
                ->get();

            return response()->json(['topgrade_name' => $topgrade->name,'othergrades' => $othergrades,'curriculums' => $curriculums,]);
        }
        // 初期表示の学年id
        $topgrade_id = 1;
        $grade = new Grade();
        $grades = $grade -> getList();
        $topgrade = $grade -> getListById($topgrade_id);
        $othergrades = $grade -> getListOtherById($topgrade_id);

        $curriculums = Curriculum::with('deliveryTimes')
            ->where('grade_id', $topgrade_id)
            ->get();
        
        return view('admin/curriculum_list',[ 'grades' => $grades, 'topgrade' => $topgrade, 'othergrades' => $othergrades, 'curriculums' => $curriculums]);
    }

    public function showCurriculumCreate() {
        $grade = new Grade();
        $grades = $grade -> getList();
        return view('admin/curriculum_create',['grades' => $grades]);
    }

    public function showCurriculumAdd(CurriculumRequest $request) {
        DB::beginTransaction();
        try {
            $curriculum = new Curriculum();
            $curriculum -> grade_id = $request -> grade_id;
            $curriculum -> title = $request -> title;
            $curriculum -> video_url = $request -> video_url;
            $curriculum -> description = $request -> description;
            $curriculum -> alway_delivery_flg = $request -> boolean('alway_delivery_flg');
            if($request -> hasFile('thumbnail')) {
                $img = $request -> file('thumbnail');
                $img_name = $img -> getClientOriginalName();
                $img->storeAs('public/images', $img_name);
                $img_path = 'storage/images/' . $img_name;
                $curriculum -> thumbnail = $img_path;
            }else {
                $curriculum -> thumbnail = null;
            }
            $curriculum -> save();
            DB::commit();
            return redirect()->route('admin.show.curriculum.list');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return back();
        }
    }

    public function showCurriculumEdit($id) {
        $curriculums = new Curriculum();
        $curriculum = $curriculums -> getListByid($id);
        $grade = new Grade();
        $grades = $grade -> getList();
        return view('admin/curriculum_edit',['grades' => $grades,'curriculum' => $curriculum]);
    }

    public function showCurriculumUpdate(CurriculumRequest $request) {
        DB::beginTransaction();
        try {
            $id = $request -> input('id');
            $curriculum = Curriculum::find($id);
            $curriculum -> grade_id = $request -> grade_id;
            $curriculum -> title = $request -> title;
            $curriculum -> video_url = $request -> video_url;
            $curriculum -> description = $request -> description;
            $curriculum -> alway_delivery_flg = $request -> boolean('alway_delivery_flg');
            if($request -> hasFile('thumbnail')) {
                $img = $request -> file('thumbnail');
                $img_name = $img -> getClientOriginalName();
                $img->storeAs('public/images', $img_name);
                $img_path = 'storage/images/' . $img_name;
                $curriculum -> thumbnail = $img_path;
            }else {
                $curriculum -> thumbnail = null;
            }
            $curriculum -> save();
            DB::commit();
            return redirect()->route('admin.show.curriculum.list');
        } catch (Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return back();
        }
    }
}
