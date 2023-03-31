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
        $this->validate($request, [
            'news_title' => 'required',
            'news_content' => 'required',
            'news_date' => 'required',
            'news_image' => 'nullable',
            'id_news_category' => 'required'
        ]);
        News::create($request->all());
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
