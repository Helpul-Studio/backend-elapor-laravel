<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseFormatter;
use App\Models\Report;
use App\Http\Controllers\Controller;
use App\Models\JobtaskResult;
use App\Models\Structural;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    public function getAllReport()
    {
        $user_id = Auth::user()->user_id;
        $structurals = Structural::where('principal', $user_id)->distinct()->get('subordinate')->toArray();
        $subordinates = User::whereIn('user_id', $structurals)->get('user_id');

        $subordinateID = array();
        for ($i=0; $i < $subordinates->count(); $i++) { 
            $subordinateID[] = $subordinates[$i]->user_id;
        }

        $jobtasks = JobtaskResult::
        whereNotNull('report_task_id')
        ->whereIn('subordinate', $subordinateID)
        ->groupBy('report_task_id')
        ->with('subordinate')
        ->get();

        return json_encode(['data' => $jobtasks]);
    }

    public function getAllIsidentil()
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
        return ResponseFormatter::success($jobtask, 'Detail Laporan Isidentil', 200);
    }

    public function update(Request $request,$id)
    {
        $jobtask = JobtaskResult::where('job_task_result_id', $id)->update([
            'report_note' => $request->report_note
        ]);
        return ResponseFormatter::success($jobtask, 'Detail Laporan Pekerjaan', 200);

    }
}
