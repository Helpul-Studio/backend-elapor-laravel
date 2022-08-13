<?php

namespace App\Http\Controllers\Admin;

use App\Models\Structural;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class StructuralController extends Controller
{
    public function getAllStructural()
    {
        $structurals = Structural::with(['principal', 'subordinate'])->get();
        return json_encode(['data' => $structurals]);
    }

    public function index()
    {
        $principals = User::where('user_role', 'principal')->get();
        $subordinates = User::where('user_role', 'subordinate')->get();
        return view('structural.index', compact('principals','subordinates'));
    }

    public function store(Request $request)
    {
        $structural = new Structural();
        $structural->principal = $request->principal;
        $structural->subordinate = $request->subordinate;
        $structural->save();
        return response()->json(['status' => true]);
    }
    
    public function edit($id)
    {
        $structural = Structural::where('structural_id', $id)->first();
        return response()->json($structural);
    }

    public function update(Request $request, $id)
    {
        $structural = Structural::findOrFail($id);
        $structural->principal = $request->principal;
        $structural->subordinate = $request->subordinate;
        $structural->save();
        return response()->json(['status' => true]);
    }

    public function destroy($id)
    {
        $structural = Structural::findOrFail($id);
        try {
            $structural->delete();
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
