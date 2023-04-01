<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $news = News::where('news_title', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $news = News::paginate(5);
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
        $news = News::create($request->all());;
        if ($request->hasFile('news_image')) {
            $request->file('news_image')->move('news_images/', $request->file('news_image')->getClientOriginalName());
            $news->news_image = $request->file('news_image')->getClientOriginalName();
            $news->save();
        }
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
        News::find($id)->update($request->all());
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/news')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        News::find($id)->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/news')->with('success', 'Data berhasil dihapus!');
    }
}
