<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jobtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobtaskController extends Controller
{
    public function getAllJobtask()
    {
        $user_id = Auth::user()->user_id;
        $jobtasks = Jobtask::where('principal', $user_id)->get();
        dd($jobtasks);
        return json_encode(['data' => $jobtasks]);
    }

    public function index()
    {
        return view('user.index');
    }

    // public function store(Request $request)
    // {
    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = Hash::make($request->password);   
    //     $user->occupation = $request->occupation;
    //     $user->user_role = $request->user_role;
    //     if ($request->hasFile('user_photo')) {
    //         $validate = Validator::make($request->all(), [
    //             'user_photo' => 'required|mimes:png,jpg,jpeg'
    //         ]);
    //         $user->user_photo = $request->file('user_photo')->store('user_photo', 'public');
    //     }

    //     $user->save();

    //     return response()->json(['status' => true]);
    // }

    // public function edit($id)
    // {
    //     $user = User::where('user_id', $id)->first();
    //     return response()->json($user);
    // }

    // public function update(Request $request, $id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->occupation = $request->occupation;
    //     $user->user_role = $request->user_role;
        
    // if ($request->hasFile('user_photo')) {
    //         $validate = Validator::make($request->all(), [
    //             'user_photo' => 'required|mimes:png,jpg,jpeg'
    //         ]);
    //         if ($user->user_photo != null) {
    //         Storage::disk('public')->delete($user->user_photo);
    //         $user->user_photo = $request->file('user_photo')->store('user_photo', 'public');
    //     }
    //     $user->user_photo = $request->file('user_photo')->store('user_photo', 'public');
    // }

    //     if($request->has('password')){
    //         $user->password = Hash::make($request->password);   
    //     }
    //     $user->save();
    //     return response()->json(['status' => true]);
    // }
    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     try {
    //         Storage::disk('public')->delete($user->user_photo);
    //         $user->delete();
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Data successfully deleted'
    //         ]);
    //     } catch (QueryException $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->errorInfo
    //         ]);
    //     }
    // }
}
