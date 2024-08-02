<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Models\News;
use App\Http\Controllers\Controller;

class GuestNewsController extends Controller
{

    public function showNews()
    {
        $news = News::orderBy('date', 'desc')->orderBy('time', 'desc')->take(3)->get();
        return view('news.index', compact('news'));
    }

    public function fetchNews($offset)
    {
        $news = News::orderBy('date', 'desc')->orderBy('time', 'desc')->skip($offset)->take(3)->get();
        return response()->json($news);
    }
    

    public function show($id)
    {
        $newsItem = News::findOrFail($id);
        return view('guest.news.showone', compact('newsItem'));
    }

    public function list()
    {
        return view('guest.news.list');
    }
}
