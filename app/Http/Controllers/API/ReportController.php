<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\JobtaskResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    public function index()
    {
        $user = Auth::user()->user_id;
        $jobtask = JobtaskResult::whereNotNull('report_task_id')
        ->groupBy('report_task_id')
        ->where('subordinate', $user)
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

        $validate = Validator::make($request->all(), [
            'sector_id' => 'required',
            'location_latitude' => 'required',
            'location_longitude' => 'required',

            'report_about' => 'required',
            'report_source_information' => 'required',
            'report_date' => 'required',
            'report_place' => 'required',
            'report_activities' => 'required',
            'report_analysis' => 'required',
            'report_prediction' => 'required',
            'report_steps_taken' => 'required',
            'report_recommendation' => 'required',
            'jobtask_documentation' => 'required|mimes:png,jpg,jpeg'
        ]);

        if ($validate->fails()) {
            return ResponseFormatter::error(null, $validate->errors(), 400);
        }


        $report = new JobtaskResult();
        $report->report_type = 'Isidentil';
        $report->report_task_id = $randID.$user;
        $report->location_latitude = $request->location_latitude;
        $report->subordinate = Auth::user()->user_id;
        $report->location_longitude = $request->location_longitude;

        if ($request->hasFile('jobtask_documentation')) {
            $report->jobtask_documentation = $request->file('jobtask_documentation')->store('jobtask_documentation', 'public');
        }

        $report->report_about = $request->report_about;
        $report->report_source_information = $request->report_source_information;
        $report->report_date = $request->report_date; 
        $report->report_place = $request->report_place;
        $report->report_activities = $request->report_activities; 
        $report->report_analysis = $request->report_analysis;
        $report->report_prediction = $request->report_prediction;
        $report->report_steps_taken = $request->report_steps_taken;
        $report->report_recommendation = $request->report_recommendation;
        $report->save();

        return ResponseFormatter::success($report, 'Berhasil Upload Laporan', 200);
        

    }
}
