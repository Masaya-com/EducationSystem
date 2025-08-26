<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{

    // 必要ならカラムを指定
    protected $fillable = ['name'];
}