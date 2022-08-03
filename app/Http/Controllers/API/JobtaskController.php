<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jobtask;
use Illuminate\Support\Facades\Auth;

class JobtaskController extends Controller
{
    public function index()
    {
        $user = Auth::user()->user_id;
        $jobtask = Jobtask::where('subordinate', $user)->get();
        
        return ResponseFormatter::success($jobtask, 'Data Semua Pekerjaan', 200);
    }

    public function show($id)
    {
        $jobtask = Jobtask::where('job_task_id', $id)->get();
        return ResponseFormatter::success($jobtask, 'Detail Pekerjaan', 200);
    }
}
