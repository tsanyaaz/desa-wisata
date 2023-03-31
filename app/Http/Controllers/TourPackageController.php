<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class TourPackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $tourPackages = TourPackage::where('tp_name', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $tourPackages = TourPackage::paginate(5);
            Session::put('page', request()->fullUrl());
        }
        return view('tourPackages/index', compact('tourPackages'));
    }

    public function create()
    {
        return view('tourPackages/create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tp_name' => 'required',
            // 'tp_desc' => 'required',
            'tp_facilities' => 'required',
            'tp_price' => 'required',
            // 'tp_discount' => 'required',
        ]);
        TourPackage::create($request->all());
        return redirect('/tourPackages')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tourPackages = TourPackage::find($id);
        return view('tourPackages/edit', compact('tourPackages'));
    }

    public function update(Request $request, $id)
    {
        TourPackage::find($id)->update($request->all());
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/tourPackages')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        TourPackage::find($id)->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/tourPackages')->with('success', 'Data berhasil dihapus!');
    }
}
