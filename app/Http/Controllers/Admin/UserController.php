<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUser()
    {
        $users = User::all();
        return json_encode(['data' => $users]);
    }

    public function index()
    {
        return view('users.index');
    }
}
