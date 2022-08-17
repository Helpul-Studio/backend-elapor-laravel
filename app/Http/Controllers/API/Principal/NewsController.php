<?php

namespace App\Http\Controllers\API\Principal;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function getAllNews()
    {
        $news = News::with(['sector', 'principal'])->get();
        return ResponseFormatter::success($news, 'Data Semua Berita', 200);

    }

    public function store(Request $request)
    {
        $news = new News();
        $news->principal =  Auth::user()->user_id;
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

        return ResponseFormatter::success($news, 'Berhasil Menambahkan Berita', 200);

    }

    public function show($id)
    {
        $news = News::where('news_id', $id)->first();
        return response()->json($news);

    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);
        $news->principal =  Auth::user()->user_id;
        $news->sector_id = $request->sector_id;
        $news->news_title = $request->news_title;
        $news->news_field = $request->news_field;
        
        if ($request->hasFile('news_image')) {
            $validate = Validator::make($request->all(), [
                'news_image' => 'required|mimes:png,jpg,jpeg'
            ]);
            Storage::disk('public')->delete($news->news_image);
            $news->news_image = $request->file('news_image')->store('news_image', 'public');
        }

        $news->save();

        return ResponseFormatter::success($news, 'Berhasil Mengedit Berita', 200);
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
