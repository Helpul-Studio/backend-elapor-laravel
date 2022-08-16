<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function getAllSector()
    {
        $sectors = Sector::all();
        return json_encode(['data' => $sectors]);
    }
    
    public function index()
    {
        return view('sector.index');
    }

    public function store(Request $request)
    {
        $sector = new Sector();
        $sector->sector_name = $request->sector_name;
        $sector->save();

        return response()->json(['status' => true]);
    }

    public function edit($id)
    {
        $sector = Sector::where('sector_id', $id)->first();
        return response()->json($sector);

    }

    public function update(Request $request, $id)
    {
        $sector = Sector::findOrFail($id);
        $sector->sector_name = $request->sector_name;
        $sector->save();

        return response()->json(['status' => true]);
    }

    public function destroy($id)
    {
        $sector = Sector::findOrFail($id);
        try {
            $sector->delete();
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
