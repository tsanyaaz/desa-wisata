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
        // $touristAttractions = TouristAttraction::all();
        return view('touristAttractions/index', compact('touristAttractions'));
    }

    public function create()
    {
        $tourismCategories = TourismCategory::all();
        // $pictures = Picture::all();
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
        // $files = File::allFiles(public_path($directory));
        $files = Storage::allFiles(($directory));

        foreach ($files as $file) {
            // $path = $file->getRelativePathname();
            // $url = URL::asset($directory . '/' . $path);
            $url = Storage::url($file);
            $pictures[] = $url;
        }
        return redirect()->route('touristAttractions.index');
    }
    // public function store(Request $request)
    // {
    //     $touristAttractions = TouristAttraction::create([
    //         'ta_name' => $request->ta_name,
    //         'ta_desc' => $request->ta_desc,
    //         'ta_facilities' => $request->ta_facilities,
    //         'id_tourism_category' => $request->id_tourism_category
    //     ]);

    //     if ($request->hasFile('pictures')) {
    //         $picturePaths = [];
    //         foreach ($request->file('pictures') as $pictures) {
    //             $picturePath = $pictures->store('pictures');
    //             $picturePaths[] = $picturePath;
    //         }

    //         foreach ($picturePaths as $picturePath) {
    //             Picture::create([
    //                 'id_tourist_attraction' => $touristAttractions->id,
    //                 'file_name' => $picturePath,
    //             ]);
    //         }
    //     }

    //     return redirect()->route('/touristAttractions');
    // }
    // public function store(Request $request)
    // {
    //     $touristAttractions = TouristAttraction::create($request->only(['ta_name', 'ta_desc', 'ta_facilities', 'id_tourism_category']));
    //     if ($request->hasFile('picture')) {
    //         foreach ($request->file('picture') as $file) {
    //             $name = $file->getClientOriginalName();
    //             $file->move('tourAttractionPicts/', $name);
    //             $picture = new Picture(['file_name' => $name]);
    //             $touristAttractions->picture()->save($picture);
    //         }
    //     }
    //     return redirect('/touristAttractions')->with('success', 'Data berhasil ditambahkan!');
    // }

    // $touristAttractions = TouristAttraction::create($request->all());
    // if ($request->hasFile('id_picture')) {
    //     $pictures = [];
    //     foreach ($request->file('id_picture') as $file) {
    //         $name = $file->getClientOriginalName();
    //         $file->move('pictures/', $name);
    //         $pictures[] = new Picture(['file_name' => $name]);
    //     }
    //     $touristAttractions->pictures()->saveMany($pictures);
    //     $touristAttractions->save();
    // }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'ta_name' => 'required',
    //         'ta_desc' => 'required',
    //         'ta_facilities' => 'required',
    //         'id_tourism_category' => 'required',
    //         'id_picture' => 'nullable|array',
    //         'id_picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
    //     ]);

    //     $touristAttractions = TouristAttraction::create($request->all());

    //     if ($request->hasFile('id_picture')) {
    //         $pictures = [];
    //         foreach ($request->file('id_picture') as $file) {
    //             $name = $file->getClientOriginalName();
    //             $file->storeAs('public/foto', $name);
    //             $pictures[] = new Picture(['file_name' => $name]);
    //         }
    //         $touristAttractions->pictures()->saveMany($pictures);
    //     }
    //     return redirect('/touristAttractions')->with('success', 'Data berhasil ditambahkan!');
    // }
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'ta_name' => 'required',
    //         'ta_desc' => 'required',
    //         'ta_facilities' => 'required',
    //         'id_tourism_category' => 'required',
    //         'id_picture' => 'nullable|array',
    //         'id_picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
    //     ]);

    //     $touristAttractions = TouristAttraction::create($request->all());

    //     if ($request->hasFile('id_picture')) {
    //         $pictures = [];
    //         foreach ($request->file('id_picture') as $file) {
    //             $name = $file->getClientOriginalName();
    //             $file->storeAs('public/foto', $name);
    //             $pictures[] = new Picture(['file_name' => $name]);
    //         }
    //         $touristAttractions->pictures()->saveMany($pictures);
    //     }
    //     return redirect('/touristAttractions')->with('success', 'Data berhasil ditambahkan!');
    // }

    public function edit($id)
    {
        $touristAttractions = TouristAttraction::find($id);
        $tourismCategories = TourismCategory::all();
        return view('touristAttractions/edit', compact('touristAttractions', 'tourismCategories'));
    }

    public function update(Request $request, $id)
    {
        TouristAttraction::find($id)->update($request->all());
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/touristAttractions')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        TouristAttraction::find($id)->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/touristAttractions')->with('success', 'Data berhasil dihapus!');
    }
}
