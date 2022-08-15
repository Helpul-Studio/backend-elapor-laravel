<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jobtask;
use App\Models\JobtaskSubordinate;
use Illuminate\Support\Facades\Auth;

class JobtaskController extends Controller
{
    public function index()
    {
        $user = Auth::user()->user_id;
        $jobtask = JobtaskSubordinate::where('subordinate', $user)
        ->with('jobtask')
        ->get();

        return ResponseFormatter::success($jobtask, 'Data Semua Pekerjaan', 200);
    }

    public function show($id)
    {
        $jobtask = Jobtask::where('job_task_id', $id)->get();
        return ResponseFormatter::success($jobtask, 'Detail Pekerjaan', 200);
    }
}
