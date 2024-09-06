<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Shift;
use Illuminate\Support\Facades\Log;

class ShiftController extends Controller
{
    public function index()
    {
        return view('shifts.index');
    }

    public function getShifts()
    {
        $shifts = Shift::all()->map(function ($shift) {
            return [
                'title' => $shift->employee->name,
                'day' => $shift->day,
                // 'end' => $shift->end_time,
            ];
        });

        return response()->json($shifts);
    }

    public function getDailyStaff(Request $request)
    {

        $date = $request->input('date');
        $shifts = Shift::whereDate('day', $date)->with('employee')->get();

        $dailyStaff = $shifts->map(function ($shift) {
            return [
                'name' => $shift->employee ? $shift->employee->name : 'Unknown',
            ];
        });

        return response()->json($dailyStaff);
    }

    public function submitShift(Request $request)
    {
        $shifts = $request->input('shifts');
        $employeeId = Auth::id(); // 現在ログインしているユーザーのIDを取得

        foreach ($shifts as $day) {
            Shift::create([
                'employee_id' => $employeeId,
                'day' => $day,
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function checkPayment()
    {
        // 給与確認のロジックをここに実装
    }


}

?>
