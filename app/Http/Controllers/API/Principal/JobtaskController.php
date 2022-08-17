<?php

namespace App\Http\Controllers\API\Principal;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Jobtask;
use App\Models\JobtaskSubordinate;
use App\Models\Structural;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobtaskController extends Controller
{
    public function getAllJobtask()
    {
        $user_id = Auth::user()->user_id;
        $jobtasks = Jobtask::where('principal', $user_id)
        ->with(['jobtaskSubordinate.subordinate', 'principal', 'sector'])
        ->get();
        return json_encode(['data' => $jobtasks]);
    }

    public function getSubordinate()
    {
        $user_id = Auth::user()->user_id;
        $structurals = Structural::where('principal', $user_id)->distinct()->get('subordinate')->toArray();
        $subordinates = User::whereIn('user_id', $structurals)->get();
        return json_encode(['data' => $subordinates]);
    }

    public function store(Request $request)
    {
        $jobtask = new Jobtask();
        $jobtask->principal =  Auth::user()->user_id;
        $jobtask->sector_id = $request->sector_id;
        $jobtask->job_task_name = $request->job_task_name;
        $jobtask->job_task_place = $request->job_task_place;
        $jobtask->job_task_date = $request->job_task_date;
        $jobtask->save();

        
            
        $data = JobtaskSubordinate::create([
            'job_task_id' => $jobtask->job_task_id,
            'subordinate' => $request->subordinate
        ]);
    

        return ResponseFormatter::success($jobtask, 'Berhasil Menambahkan Pekerjaan', 200);
    }

    public function show($id)
    {
        $jobtask = Jobtask::where('job_task_id', $id)->with('jobtaskResult.subordinate', 'sector')
        ->first();
        return response()->json($jobtask);
    }

    public function update(Request $request, $id)
    {
        $jobtask = Jobtask::findOrFail($id);
        $jobtask->sector_id = $request->sector_id;
        $jobtask->job_task_name = $request->job_task_name;
        $jobtask->job_task_date = $request->job_task_date;
        $jobtask->job_task_note = $request->job_task_note;
        $jobtask->job_task_place = $request->job_task_place;
        
        if($request->job_task_status == 'Ditolak'){
            $jobtask->job_task_status = $request->job_task_status;
            $jobtask->jobtaskResult()->delete();
        }else{
            $jobtask->job_task_status = $request->job_task_status;
        }

        $jobtask->job_task_rating = $request->job_task_rating;
        $jobtask->save();
        return ResponseFormatter::success($jobtask, 'Berhasil Mengedit Pekerjaan', 200);
    }

    public function destroy($id)
    {
        $jobtask = Jobtask::findOrFail($id);
        try {
             $jobtask->delete();
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
}
