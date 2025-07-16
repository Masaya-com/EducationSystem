<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Grade extends Model
{
    use HasFactory;
    //全件取得
    public function getList() {
        $grades = DB::table('grades')
            ->get();
        return $grades;
    }
    //一件取得
    public function getListById($id) {
        $grade = DB::table('grades')
            ->where('id', '=' , $id)
            ->first();
        return $grade;
    }
    //引数以外を取得
    public function getListOtherById($id) {
        $grades = DB::table('grades')
            ->where('id', '!=', $id)
            ->get();
        return $grades;
    }
}
