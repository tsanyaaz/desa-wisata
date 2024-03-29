<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homestay;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Picture;
use Illuminate\Support\Facades\Storage;

class HomestayController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $homestays = Homestay::where('h_name', 'LIKE', '%' . $request->search . '%')->with('pictures')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $homestays = Homestay::with('pictures')->paginate(5);
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
            'h_facilities' => 'required',
            'picture' => 'required|array|min:1',
            'picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $homestays = Homestay::create($request->only('h_name', 'h_desc', 'h_facilities'));
        $directory = 'homestays/' . $homestays->id;
        foreach ($request->file('picture') as $picture) {
            Picture::store($picture, $directory, $homestays, false);
        }

        $pictures = array();
        $files = Storage::allFiles(($directory));

        foreach ($files as $file) {
            $url = Storage::url($file);
            $pictures[] = $url;
        }
        return redirect('/homestays')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $homestays = Homestay::find($id);
        return view('homestays/edit', compact('homestays'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'h_name' => 'required',
            'h_desc' => 'required',
            'h_facilities' => 'required',
            'picture' => 'required|array|min:1',
            'picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $homestays = Homestay::find($id);
        $homestays->update([
            'h_name' => $request->h_name,
            'h_desc' => $request->h_desc,
            'h_facilities' => $request->h_facilities,
        ]);
        if ($request->hasFile('picture')) {
            foreach ($homestays->pictures as $picture) {
                Storage::delete($picture->path);
                $picture->delete();
            }
            $files = $request->file('picture');
            $images = [];
            $directory = 'homestays/' . $id;
            foreach ($files as $file) {
                Picture::store($file, $directory, $homestays, false);
                $images[] = $file->getClientOriginalName();
            }
        } else {
            $directory = 'homestays/' . $id;
        }
        $homestays->save();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/homestays')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $homestays = Homestay::find($id);
        $homestays->pictures()->delete();
        $homestays->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/homestays')->with('success', 'Data berhasil dihapus!');
    }

    public function show($id)
    {
        $homestays = Homestay::find($id);
        return view('homestays/show', compact('homestays'));
    }
}
