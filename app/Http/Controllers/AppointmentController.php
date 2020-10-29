<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function order(Request $request)
    {
        $student_number = $request->student_number;
        $data = Appointment::where('student_number',$student_number)->get();
        return response()->json([
           'message' => '查询成功',
           'data'    => $data
        ]);

    }
}
