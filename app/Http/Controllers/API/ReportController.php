<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\JobtaskResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user()->user_id;
        $jobtask = JobtaskResult::whereNotNull('report_task_id')
        ->groupBy('report_task_id')
        ->where('subordinate', $user)
        ->with('jobtask')
        ->get();    
        return ResponseFormatter::success($jobtask, 'Data Semua Laporan', 200);
    }

    public function show($id)
    {
        $jobtask = JobtaskResult::where('report_task_id', $id)->get();
        return ResponseFormatter::success($jobtask, 'Detail Laporan', 200);
    }

    public function store(Request $request)
    {
        $user = Auth::user()->user_id;  
        $randID = rand();

        $files = $request->file('jobtask_documentation');

        if($request->hasFile('jobtask_documentation')){
            $jobtask_documentations = $request->file('jobtask_documentation');

            $data = array();
            foreach ($jobtask_documentations as $image) {
                $url = $image->store('jobtask_documentation', 'public');
                
                $data = JobtaskResult::create([
                    'report_type' => 'Isidentil',
                    'subordinate' =>  Auth::user()->user_id,
                    'location_latitude' => $request->location_latitude,
                    'location_longitude' => $request->location_longitude,
                    'jobtask_documentation' => $url,

                    'report_about' => $request->report_about,
                    'report_source_information' => $request->report_source_information,
                    'report_date' => $request->report_date, 
                    'report_place' => $request->report_place,
                    'report_activities' => $request->report_activities, 
                    'report_analysis' => $request->report_analysis,
                    'report_prediction' => $request->report_prediction,
                    'report_steps_taken' => $request->report_steps_taken,
                    'report_recommendation' => $request->report_recommendation,

                    'report_task_id' => $randID.$user,
                ]);
            }
            return ResponseFormatter::success($data, 'Berhasil Upload Laporan', 200);
        }

    }
}
