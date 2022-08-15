<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Helpers\ResponseFormatter;
use App\Models\Jobtask;
use App\Models\JobtaskSubordinate;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->all();
        $user = User::where('nrp', $request->nrp)->first();

        if (!Auth::attempt($validated)) {
            return ResponseFormatter::error(null, 'Login gagal. NRP atau Password salah. Silahkan Hubungi Admin.', 401);
        }else{
            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer'
            ], 'Login berhasil.', 200);
        }
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return responseFormatter::success(null, 'Logout Berhasil', 200);
    }

    public function profile()
    {
        $user = Auth::user();

        $jobtask = JobtaskSubordinate::where('subordinate', $user->user_id)
        ->with('jobtask')
        ->get();

        $JOBTASKID = array();
        for ($i=0; $i < $jobtask->count(); $i++) { 
            $JOBTASKID[] = $jobtask[$i]->job_task_id;
        }

        $done = Jobtask::whereIn('job_task_id', $JOBTASKID)
        ->where('job_task_status', 'Selesai')
        ->count();

        $assigned = Jobtask::whereIn('job_task_id', $JOBTASKID)
        ->where('job_task_status', 'Ditugaskan')
        ->count();

        $waiting = Jobtask::whereIn('job_task_id', $JOBTASKID)
        ->where('job_task_status', 'Menunggu Konfirmasi')
        ->count();

        

        return ResponseFormatter::success([$user, 
        ["status_pekerjaan" => [
            ["selesai" => $done], 
            ["ditugaskan" => $assigned], 
            ["menunggu_konfirmasi" => $waiting],
        ]]
    ], 
        'Data Profile ' .$user->name, 
        200);
    }
}
