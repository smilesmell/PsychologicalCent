<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function search()
    {
        $data = Teacher::all();
        return response()->json([
            'message' => '查询成功',
            'data'    =>  $data,
        ],200);
    }

}
