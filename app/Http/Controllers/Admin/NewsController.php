<?php
namespace App\Http\Controllers\Admin;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends AdminBaseController
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'title' => 'required|string|max:255',
            'short_content' => 'required|string',
            'full_content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $originalName = $request->file('photo')->getClientOriginalName();
            $photoPath = '/storage/' . $request->file('photo')->storeAs('news_photos', $originalName, 'public');
        } elseif ($request->photo_url) {
            $photoPath = $request->photo_url;;
        } else {
            $photoPath = null;
        }

        News::create(array_merge($request->all(), ['photo' => $photoPath]));

        return redirect()->route('admin.news.index')->with('success', 'Новина успішно створена');
    }

    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required',
            'title' => 'required|string|max:255',
            'short_content' => 'required|string',
            'full_content' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            if ($news->photo) {
                Storage::disk('public')->delete($news->photo);
            }
            $originalName = $request->file('photo')->getClientOriginalName();
            $photoPath = "/storage/" . $request->file('photo')->storeAs('news_photos', $originalName, 'public');
        } elseif ($request->photo_url) {
            $photoPath = $request->photo_url;
        }

        $news->update(array_merge($request->all(), ['photo' => $photoPath]));

        return redirect()->route('admin.news.index')->with('success', 'Новина успішно оновлена');
    }

    public function destroy(News $news)
    {
        if ($news->photo && !filter_var($news->photo, FILTER_VALIDATE_URL)) {
            Storage::disk('public')->delete($news->photo);
        }
        $news->delete();

        return redirect()->route('admin.news.index')->with('success', 'Новина успішно видалена');
    }
}
