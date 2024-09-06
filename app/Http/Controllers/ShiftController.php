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
        Log::debug('受け取った日付: ' . $date);

        $shifts = Shift::whereDate('day', $date)->with('employee')->get();
        Log::debug('クエリ結果: ' . $shifts->toJson());

        $dailyStaff = $shifts->map(function ($shift) {
            Log::debug('シフト: ' . json_encode($shift));
            Log::debug('従業員: ' . json_encode($shift->employee));
            return [
                'name' => $shift->employee ? $shift->employee->name : 'Unknown',
            ];
        });

        return response()->json($dailyStaff);
    }

    public function submitShift(Request $request)
    {
        // シフト提出のロジックをここに実装
    }

    public function checkPayment()
    {
        // 給与確認のロジックをここに実装
    }


}

?>
