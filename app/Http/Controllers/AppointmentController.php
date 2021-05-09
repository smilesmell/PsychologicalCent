<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function my_order(Request $request)
    {
        $student_number = $request->student_number;
        $data = Appointment::where('student_number',$student_number)->get();
        return response()->json([
           'message' => '查询成功',
           'data'    => $data
        ]);

    }
    public function way(Request $request)
    {
        $way = $request->way;
//        dd($way);
        Appointment::updateOrInsert([
            'way' => $way,
        ]);

        return response()->json([
           'message' => '预约方式更新成功'
        ]);
    }
    public function order()
    {
        Appointment::update('state','1');
    }
}
