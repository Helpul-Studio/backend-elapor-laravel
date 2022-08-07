<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jobtask;
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
        ->with('subordinate')
        ->get();
        return json_encode(['data' => $jobtasks]);
    }

    public function index()
    {
        $subordinates = User::where('user_role', 'subordinate')->get();
        return view('jobtask.index', compact('subordinates'));
    }

    public function store(Request $request)
    {
        $jobtask = new Jobtask();
        $jobtask->principal = $request->principal;
        $jobtask->subordinate = $request->subordinate;
        $jobtask->job_task_name = $request->job_task_name;
        $jobtask->job_task_date = $request->job_task_date;
        $jobtask->save();

        return response()->json(['status' => true]);
    }

    public function edit($id)
    {
        $jobtask = Jobtask::where('job_task_id', $id)->first();
        return response()->json($jobtask);
    }

    public function update(Request $request, $id)
    {
        $jobtask = Jobtask::findOrFail($id);
        $jobtask->principal = $request->principal;
        $jobtask->subordinate = $request->subordinate;
        $jobtask->job_task_name = $request->job_task_name;
        $jobtask->job_task_date = $request->job_task_date;
        $jobtask->job_task_status = $request->job_task_status;
        $jobtask->job_task_rating = $request->job_task_rating;
        $jobtask->save();
        return response()->json(['status' => true]);
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
