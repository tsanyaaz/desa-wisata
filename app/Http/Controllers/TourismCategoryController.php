<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourismCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class TourismCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $tourismCategories = TourismCategory::where('tc_name', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $tourismCategories = TourismCategory::paginate(5);
            Session::put('page', request()->fullUrl());
        }
        return view('tourismCategories/index', compact('tourismCategories'));
    }

    public function create()
    {
        return view('tourismCategories/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tc_name' => 'required'
        ]);
        TourismCategory::create($request->all());
        return redirect('/tourismCategories')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tourismCategories = TourismCategory::find($id);
        return view('tourismCategories/edit', compact('tourismCategories'));
    }

    public function update(Request $request, $id)
    {
        TourismCategory::find($id)->update($request->all());
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/tourismCategories')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        TourismCategory::find($id)->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/tourismCategories')->with('success', 'Data berhasil dihapus!');
    }
}
