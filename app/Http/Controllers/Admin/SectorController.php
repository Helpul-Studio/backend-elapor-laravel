<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function getAllSector()
    {
        $sectors = Sector::all();
        return json_encode(['data' => $sectors]);
    }
}
