<?php

namespace App\Http\Controllers\API\Principal;

use App\Http\Controllers\Controller;
use App\Models\Jobtask;
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
}
