<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class NewsCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $newsCategories = NewsCategory::where('nc_name', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $newsCategories = NewsCategory::paginate(5);
            Session::put('page', request()->fullUrl());
        }
        return view('newsCategories/index', compact('newsCategories'));
    }

    public function create()
    {
        return view('newsCategories/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nc_name' => 'required'
        ]);
        NewsCategory::create($request->all());
        return redirect('/newsCategories')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $newsCategories = NewsCategory::find($id);
        return view('newsCategories/edit', compact('newsCategories'));
    }

    public function update(Request $request, $id)
    {
        NewsCategory::find($id)->update($request->all());
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/newsCategories')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        NewsCategory::find($id)->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/newsCategories')->with('success', 'Data berhasil dihapus!');
    }
}
