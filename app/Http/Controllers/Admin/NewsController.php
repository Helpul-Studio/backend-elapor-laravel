<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function getAllNews()
    {
        $news = News::with(['sector', 'principal'])->get();
        return json_encode(['data' => $news]);
    }

    public function index()
    {
        $sectors = Sector::all();
        return view('news.index', compact('sectors'));
    }

    public function store(Request $request)
    {
        $news = new News();
        $news->principal = $request->principal;
        $news->sector_id = $request->sector_id;
        $news->news_title = $request->news_title;
        $news->news_field = $request->news_field;

        if ($request->hasFile('news_image')) {
            $validate = Validator::make($request->all(), [
                'news_image' => 'required|mimes:png,jpg,jpeg'
            ]);
            $news->news_image = $request->file('news_image')->store('news_image', 'public');
        }
        $news->save();

        return response()->json(['status' => true]);

    }

    public function edit($id)
    {
        $news = News::where('news_id', $id)->first();
        return response()->json($news);

    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $news->principal = $request->principal;
        $news->sector_id = $request->sector_id;
        $news->news_title = $request->news_title;
        $news->news_field = $request->news_field;
        
        if ($request->hasFile('news_image')) {
            $validate = Validator::make($request->all(), [
                'news_image' => 'required|mimes:png,jpg,jpeg'
            ]);
            $news->news_image = $request->file('news_image')->store('news_image', 'public');
        }

        $news->save();

        return response()->json(['status' => true]);
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
