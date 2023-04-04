<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Picture;
use Illuminate\Support\Facades\Storage;

class TourPackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $tourPackages = TourPackage::where('tp_name', 'LIKE', '%' . $request->search . '%')->with('pictures')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $tourPackages = TourPackage::with('pictures')->paginate(5);
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
            'tp_desc' => 'required',
            'tp_facilities' => 'required',
            'tp_price' => 'required',
            'tp_discount' => 'nullable|numeric|between:0,100',
            'picture' => 'required|array|min:1',
            'picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $tourPackages = TourPackage::create($request->only('tp_name', 'tp_desc', 'tp_facilities', 'tp_price', 'tp_discount'));
        $directory = 'tourPackages/' . $tourPackages->id;
        foreach ($request->file('picture') as $picture) {
            Picture::store($picture, $directory, $tourPackages, false);
        }

        $pictures = array();
        $files = Storage::allFiles(($directory));

        foreach ($files as $file) {
            $url = Storage::url($file);
            $pictures[] = $url;
        }
        return redirect('/tourPackages')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $tourPackages = TourPackage::find($id);
        return view('tourPackages/edit', compact('tourPackages'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tp_name' => 'required',
            'tp_desc' => 'required',
            'tp_facilities' => 'required',
            'tp_price' => 'required',
            'tp_discount' => 'nullable|numeric|between:0,100',
        ]);

        $tourPackages = TourPackage::find($id);
        $tourPackages->update([
            'tp_name' => $request->tp_name,
            'tp_desc' => $request->tp_desc,
            'tp_facilities' => $request->tp_facilities,
            'tp_price' => $request->tp_price,
            'tp_discount' => $request->tp_discount,
        ]);
        if ($request->hasFile('picture')) {
            foreach ($tourPackages->pictures as $picture) {
                Storage::delete($picture->path);
                $picture->delete();
            }
            $files = $request->file('picture');
            $images = [];
            $directory = 'tourPackages/' . $id;
            foreach ($files as $file) {
                Picture::store($file, $directory, $tourPackages, false);
                $images[] = $file->getClientOriginalName();
            }
        } else {
            $directory = 'tourPackages/' . $id;
        }
        $tourPackages->save();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/tourPackages')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $tourPackages = TourPackage::find($id);
        $tourPackages->pictures()->delete();
        $tourPackages->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/tourPackages')->with('success', 'Data berhasil dihapus!');
    }
}
