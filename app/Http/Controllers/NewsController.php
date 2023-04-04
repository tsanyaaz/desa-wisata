<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Picture;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $news = News::where('news_title', 'LIKE', '%' . $request->search . '%')->with('pictures')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $news = News::with('pictures')->paginate(5);
            Session::put('page', request()->fullUrl());
        }
        // $news = News::all();
        return view('news/index', compact('news'));
    }

    public function create()
    {
        $newsCategories = NewsCategory::all();
        return view('news/create', compact('newsCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'news_title' => 'required',
            'news_content' => 'required',
            'news_date' => 'required',
            'id_news_category' => 'required',
            'picture' => 'required|array|min:1',
            'picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $news = News::create($request->only(['news_title', 'news_content', 'news_date', 'id_news_category']));
        $directory = 'news/' . $news->id;
        foreach ($request->file('picture') as $picture) {
            Picture::store($picture, $directory, $news, false);
        }
        $pictures = array();
        $files = Storage::allFiles(($directory));
        foreach ($files as $file) {
            $url = Storage::url($file);
            $pictures[] = $url;
        }
        // if ($request->hasFile('news_image')) {
        //     $request->file('news_image')->move('news_images/', $request->file('news_image')->getClientOriginalName());
        //     $news->news_image = $request->file('news_image')->getClientOriginalName();
        //     $news->save();
        // }
        // $request->validate([
        //     'news_title' => 'required',
        //     'news_content' => 'required',
        //     'news_date' => 'required',
        //     'news_image' => 'required|image|file|max:2048',
        //     'id_news_category' => 'required'
        // ]);
        // $array = $request->only([
        //     'news_title',
        //     'news_content',
        //     'news_date',
        //     'id_news_category'
        // ]);
        // $array['news_image'] = $request->file('news_image')->store('news_images');
        // $add = News::create($array);
        // if ($add) $request->file('news_image')->store('news_images'); {
        //     return redirect('/news')->with('success', 'Data berhasil ditambahkan!');
        // }
        // $this->validate($request, [
        //     'news_title' => 'required',
        //     'news_content' => 'required',
        //     'news_date' => 'required',
        //     'news_image' => 'required|image|file|max:2048',
        //     'id_news_category' => 'required'
        // ]);
        // News::create($request->all());
        return redirect('/news')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $news = News::find($id);
        $newsCategories = NewsCategory::all();
        return view('news/edit', compact('news', 'newsCategories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'news_title' => 'required',
            'news_content' => 'required',
            'news_date' => 'required',
            'id_news_category' => 'required',
            'picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $news = News::find($id);
        $news->update([
            'news_title' => $request->input('news_title'),
            'news_content' => $request->input('news_content'),
            'news_date' => $request->input('news_date'),
            'id_news_category' => $request->input('id_news_category'),
        ]);

        if ($request->hasFile('picture')) {
            foreach ($news->pictures as $picture) {
                Storage::delete($picture->path);
                $picture->delete();
            }
            $files = $request->file('picture');
            $images = [];
            $directory = 'news/' . $id;
            foreach ($files as $file) {
                Picture::store($file, $directory, $news, false);
                $images[] = $file->getClientOriginalName();
            }
        } else {
            $directory = 'news/' . $id;
        }
        $news->save();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/news')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $news->pictures()->delete();
        $news->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/news')->with('success', 'Data berhasil dihapus!');
    }
}
