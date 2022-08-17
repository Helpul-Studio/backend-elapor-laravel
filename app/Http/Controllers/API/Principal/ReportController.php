<?php

namespace App\Http\Controllers\API\Principal;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\JobtaskResult;
use App\Models\Structural;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $news = News::findOrFail($id);
        try {
            if($news->news_image != null){
            Storage::disk('public')->delete($news->news_image);
            }
            $news->delete();
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