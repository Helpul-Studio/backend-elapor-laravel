<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jobtask;
use App\Models\JobtaskResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $this->validate($request, [
            'location_latitude' => 'required',
            'location_longitude' => 'required',
        ],

        [
            'location_latitude.required' => 'Tidak Bisa Mendapatkan Lokasi',

            'location_longitude.required' => 'Tidak Bisa Mendapatkan Lokasi',

        ]
    );

            $jobtask_result = new JobtaskResult();
            $jobtask_result->report_type = 'Rutin';
            $jobtask_result->job_task_id =  $id;
            $jobtask_result->subordinate = Auth::user()->user_id;

            $jobtask_result->location_latitude =  $request->location_latitude;
            $jobtask_result->location_longitude =  $request->location_longitude;


            if ($request->hasFile('jobtask_documentation')) {
                $validate = Validator::make($request->all(), [
                    'jobtask_documentation' => 'required|mimes:png,jpg,jpeg'
                ]);
                $jobtask_result->jobtask_documentation = $request->file('jobtask_documentation')->store('jobtask_documentation', 'public');
            }

            $jobtask_result->save();
        

            $jobtask = Jobtask::findOrFail($id);
            $jobtask->job_task_status = 'Menunggu Konfirmasi';
            $jobtask->save();

            return ResponseFormatter::success($jobtask_result, 'Berhasil Upload Laporan Pekerjaan', 200);
        }

}

