<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jobtask;
use App\Models\JobtaskResult;
use Illuminate\Http\Request;

class JobtaskResultController extends Controller
{
    public function show($id)
    {
        $jobtask = Jobtask::where('job_task_id', $id)->with('jobtaskResult')->get();
        return ResponseFormatter::success($jobtask, 'Detail Laporan Pekerjaan', 200);
    }

    public function showreport($id)
    {
        $jobtask = JobtaskResult::where('job_task_id', $id)->get();
        return ResponseFormatter::success($jobtask, 'Detail Laporan Pekerjaan', 200);
    }


    public function store(Request $request, $id)
    {

        $files = $request->file('jobtask_documentation');

        if($request->hasFile('jobtask_documentation')){
            $jobtask_documentations = $request->file('jobtask_documentation');

            $data = array();
            foreach ($jobtask_documentations as $image) {
                $url = $image->store('jobtask_documentation', 'public');
                
                $data = JobtaskResult::create([
                    'location_latitude' => $request->location_latitude,
                    'location_longitude' => $request->location_longitude,
                    'job_task_id' => $id,
                    'jobtask_documentation' => $url
                ]);
            }
            return ResponseFormatter::success($data, 'Berhasil Upload Laporan Pekerjaan', 200);
        }

    }
}
