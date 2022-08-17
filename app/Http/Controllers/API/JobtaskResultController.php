<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jobtask;
use App\Models\JobtaskResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class   JobtaskResultController extends Controller
{
    public function show($id)
    {
        $jobtask = Jobtask::where('job_task_id', $id)->with('jobtaskResult', 'jobtaskSubordinate.subordinate')->get();
        return ResponseFormatter::success($jobtask, 'Detail Laporan Pekerjaan', 200);
    }

    public function showreport($id)
    {
        $jobtask = JobtaskResult::where('job_task_id', $id)->get();
        return ResponseFormatter::success($jobtask, 'Detail Laporan Pekerjaan', 200);
    }

    public function deletereport($id)
    {
        $jobtask = JobtaskResult::where('job_task_id', $id)->get();
        if($jobtask->jobtask_documentation != null){
            Storage::disk('public')->delete($jobtask->jobtask_documentation);
        }
        $jobtask->delete();
        return ResponseFormatter::success($jobtask, 'Detail Laporan Pekerjaan', 200);
    }

    public function store(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'location_latitude' => 'required',
            'location_longitude' => 'required',

            'jobtask_documentation' => 'required',

            'report_about' => 'required',
            'report_source_information' => 'required',
            'report_date' => 'required',
            'report_place' => 'required',
            'report_activities' => 'required',
            'report_analysis' => 'required',
            'report_prediction' => 'required',
            'report_steps_taken' => 'required',
            'report_recommendation' => 'required',
        ]);

        if ($validate->fails()) {
            return ResponseFormatter::error(null, $validate->errors(), 400);
        }

            $jobtask_result = new JobtaskResult();
            $jobtask_result->report_type = 'Rutin';
            $jobtask_result->job_task_id =  $id;
            $jobtask_result->subordinate = Auth::user()->user_id;
            $jobtask_result->location_latitude =  $request->location_latitude;
            $jobtask_result->location_longitude =  $request->location_longitude;


            $jobtask_result->jobtask_documentation = $request->file('jobtask_documentation')->store('jobtask_documentation', 'public');


                
            $jobtask_result->report_about = $request->report_about;
            $jobtask_result->report_teamwise = $request->report_teamwise;
            $jobtask_result->report_source_information = $request->report_source_information;
            $jobtask_result->report_date = Carbon::parse($request->report_date)->format('Y/m/d'); 
            $jobtask_result->report_place = $request->report_place;
            $jobtask_result->report_activities = $request->report_activities; 
            $jobtask_result->report_analysis = $request->report_analysis;
            $jobtask_result->report_prediction = $request->report_prediction;
            $jobtask_result->report_steps_taken = $request->report_steps_taken;
            $jobtask_result->report_recommendation = $request->report_recommendation;

            $jobtask_result->save();
        

            $jobtask = Jobtask::findOrFail($id);
            $jobtask->job_task_status = 'Menunggu Konfirmasi';
            $jobtask->save();

            return ResponseFormatter::success($jobtask_result, 'Berhasil Upload Laporan Pekerjaan', 200);
        }

}

