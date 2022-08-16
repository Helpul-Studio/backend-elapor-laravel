<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Models\Report;
use App\Http\Controllers\Controller;
use App\Models\JobtaskResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function getAllReport()
    {
        $jobtasks = JobtaskResult::
        whereNotNull('report_task_id')
        ->groupBy('report_task_id')
        ->with('subordinate')
        ->get();

        return json_encode(['data' => $jobtasks]);
    }

    public function index()
    {

        return view('report.index');
    }

    public function show($id)
    {
        $jobtask = JobtaskResult::where('report_task_id', $id)
        ->with(['subordinate', 'sector'])
        ->first();
        return ResponseFormatter::success($jobtask, 'Detail Laporan Pekerjaan', 200);
    }

    public function update(Request $request,$id)
    {
        $jobtask = JobtaskResult::where('job_task_result_id', $id)->update([
            'report_note' => $request->report_note
        ]);
        return ResponseFormatter::success($jobtask, 'Detail Laporan Pekerjaan', 200);

    }
}
