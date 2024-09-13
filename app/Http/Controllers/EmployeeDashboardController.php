<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
class EmployeeDashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:shifts');
    }

    public function index()
    {
        $user = Auth::user();
        $employeeName = $user->name;
        $storeName = $user->store->name ?? 'デフォルト店舗名';

        return view('shifts.index', compact('employeeName', 'storeName'));
    }
}
