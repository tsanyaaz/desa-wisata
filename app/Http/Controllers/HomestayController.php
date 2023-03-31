<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homestay;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class HomestayController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $homestays = Homestay::where('h_name', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $homestays = Homestay::paginate(5);
            Session::put('page', request()->fullUrl());
        }
        return view('homestays/index', compact('homestays'));
    }

    public function create()
    {
        return view('homestays/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'h_name' => 'required',
            'h_desc' => 'required',
            'h_facilities' => 'required'
        ]);
        Homestay::create($request->all());
        return redirect('/homestays')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $homestays = Homestay::find($id);
        return view('homestays/edit', compact('homestays'));
    }

    public function update(Request $request, $id)
    {
        Homestay::find($id)->update($request->all());
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/homestays')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        Homestay::find($id)->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/homestays')->with('success', 'Data berhasil dihapus!');
    }
}
