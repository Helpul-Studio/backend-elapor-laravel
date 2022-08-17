<?php

namespace App\Http\Controllers\API\Principal;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jobtask;
use App\Models\JobtaskResult;
use App\Models\Structural;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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

        return ResponseFormatter::success($jobtasks, "Data Semua Laporan", 200);
    }

    public function show($id)
    {
        $jobtask = JobtaskResult::where('job_task_result_id', $id)
        ->with(['subordinate', 'sector'])
        ->first();
        return ResponseFormatter::success($jobtask, 'Detail Laporan Isidentil', 200);
    }

    public function updateNote(Request $request,$id)
    {
        $jobtask = JobtaskResult::where('job_task_result_id', $id)->update([
            'report_note' => $request->report_note
        ]);
        return ResponseFormatter::success($jobtask, 'Berhasil Mengubah Laporan Isidentil', 200);

    }

    public function destroy($id)
    {
        $jobtask = DB::table('jobtask_results')->where('job_task_result_id', '=', $id)->first();
        try {
        if($jobtask->report_type == 'Rutin'){

            $jobID = $jobtask->job_task_id;
             $job = Jobtask::findOrFail($jobID);
             $job->job_task_status = 'Ditugaskan';
             $job->save();

        if($jobtask->jobtask_documentation != null){
         Storage::disk('public')->delete($jobtask->jobtask_documentation);
        }
        $jobtask = DB::table('jobtask_results')->where('job_task_result_id', $id)->delete();

        }else{
            if($jobtask->jobtask_documentation != null){
                Storage::disk('public')->delete($jobtask->jobtask_documentation);
               }
               $jobtask = DB::table('jobtask_results')->where('job_task_result_id', $id)->delete();
            }


        return response()->json([
                 'status' => true,
                 'message' => 'Data successfully deleted'
        ]);

        } catch (QueryException $e) {
             return response()->json([
                'status' => false,
                 'message' => $e->errorInfo
             ]);
        }
    }

    public function update(Request $request, $id)
    {

        $a = DB::table('jobtask_results')->where('job_task_result_id', $id)->first();

        $jobtask = DB::table('jobtask_results')->where('job_task_result_id', $id)
        ->update([
            'sector_id' => $request->sector_id,
            'location_latitude' => $request->location_latitude,
            'location_longitude' => $request->location_longitude,
            'report_about' => $request->report_about,
            'report_teamwise' => $request->report_teamwise,
            'report_source_information' => $request->report_source_information,
            'report_date' => $request->report_date,
            'report_place' => $request->report_place,
            'report_activities' => $request->report_activities,
            'report_analysis' => $request->report_analysis,
            'report_prediction' => $request->report_prediction,
            'report_steps_taken' => $request->report_steps_taken,
            'report_steps_taken' => $request->report_steps_taken,
            'report_recommendation' => $request->report_recommendation,

        ]);



        if ($request->hasFile('jobtask_documentation')) {
            $validate = Validator::make($request->all(), [
                'jobtask_documentation' => 'required|mimes:png,jpg,jpeg'
            ]);
            Storage::disk('public')->delete($a->jobtask_documentation);

            $jobtask = DB::table('jobtask_results')->where('job_task_result_id', $id)
            ->update([
                'sector_id' => $request->sector_id,
                'location_latitude' => $request->location_latitude,
                'location_longitude' => $request->location_longitude,
                'report_about' => $request->report_about,
                'report_teamwise' => $request->report_teamwise,
                'report_source_information' => $request->report_source_information,
                'report_date' => $request->report_date,
                'report_place' => $request->report_place,
                'report_activities' => $request->report_activities,
                'report_analysis' => $request->report_analysis,
                'report_prediction' => $request->report_prediction,
                'report_steps_taken' => $request->report_steps_taken,
                'report_steps_taken' => $request->report_steps_taken,
                'report_recommendation' => $request->report_recommendation,
                'jobtask_documentation' => $request->file('jobtask_documentation')->store('jobtask_documentation', 'public')
            ]);
        }

        return ResponseFormatter::success($jobtask, 'Berhasil Ubah Laporan', 200);

    }
}