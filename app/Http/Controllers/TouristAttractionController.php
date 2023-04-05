<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TouristAttraction;
use App\Models\TourismCategory;
use App\Models\Picture;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class TouristAttractionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $touristAttractions = TouristAttraction::where('ta_name', 'LIKE', '%' . $request->search . '%')->with('pictures')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $touristAttractions = TouristAttraction::with('pictures')->paginate(5);
            Session::put('page', request()->fullUrl());
        }
        return view('touristAttractions/index', compact('touristAttractions'));
    }

    public function create()
    {
        $tourismCategories = TourismCategory::all();
        return view('touristAttractions/create', compact('tourismCategories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'ta_name' => 'required',
            'ta_desc' => 'required',
            'ta_facilities' => 'required',
            'id_tourism_category' => 'required',
            'picture' => 'required|array|min:1',
            'picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $touristAttractions = TouristAttraction::create($request->only(['ta_name', 'ta_desc', 'ta_facilities', 'id_tourism_category']));
        $directory = 'touristAttractions/' . $touristAttractions->id;
        foreach ($request->file('picture') as $picture) {
            Picture::store($picture, $directory, $touristAttractions, false);
        }

        $pictures = array();
        $files = Storage::allFiles(($directory));

        foreach ($files as $file) {
            $url = Storage::url($file);
            $pictures[] = $url;
        }
        return redirect()->route('touristAttractions.index');
    }

    public function edit($id)
    {
        $touristAttractions = TouristAttraction::find($id);
        $tourismCategories = TourismCategory::all();
        return view('touristAttractions/edit', compact('touristAttractions', 'tourismCategories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'ta_name' => 'required',
            'ta_desc' => 'required',
            'ta_facilities' => 'required',
            'id_tourism_category' => 'required',
            'picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $touristAttractions = TouristAttraction::find($id);
        $touristAttractions->update([
            'ta_name' => $request->input('ta_name'),
            'ta_desc' => $request->input('ta_desc'),
            'ta_facilities' => $request->input('ta_facilities'),
            'id_tourism_category' => $request->input('id_tourism_category'),
        ]);

        if ($request->hasFile('picture')) {
            foreach ($touristAttractions->pictures as $picture) {
                Storage::delete($picture->path);
                $picture->delete();
            }
            $files = $request->file('picture');
            $images = [];
            $directory = 'touristAttractions/' . $id;
            foreach ($files as $file) {
                Picture::store($file, $directory, $touristAttractions, false);
                $images[] = $file->getClientOriginalName();
            }
        } else {
            $directory = 'touristAttractions/' . $id;
        }

        $touristAttractions->save();

        return redirect('/touristAttractions')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $touristAttractions = TouristAttraction::find($id);
        $touristAttractions->pictures()->delete();
        $touristAttractions->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/touristAttractions')->with('success', 'Data berhasil dihapus!');
    }
}
