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
        // $directory = 'touristAttractions/' . $touristAttractions->id;
        $tourismCategories = TourismCategory::all();
        // $pictures = json_decode($touristAttractions->picture);
        return view('touristAttractions/edit', compact('touristAttractions', 'tourismCategories'));
    }

    // public function update(Request $request, TouristAttraction $touristAttractions)
    // {
    //     $this->validate($request, [
    //         'ta_name' => 'required',
    //         'ta_desc' => 'required',
    //         'ta_facilities' => 'required',
    //         'id_tourism_category' => 'required',
    //         'picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    //     ]);

    //     $touristAttractions->update($request->only(['ta_name', 'ta_desc', 'ta_facilities', 'id_tourism_category']));

    //     $directory = 'touristAttractions/' . $touristAttractions->id;

    //     // if ($request->hasFile('picture')) {
    //     //     $pictures = $request->file('picture');
    //     //     foreach ($pictures as $picture) {
    //     //         Picture::store($picture, $directory, $touristAttractions, false);
    //     //     }
    //     // }
    //     if ($request->hasFile('picture')) {
    //         foreach ($touristAttractions->pictures as $picture) {
    //             Storage::delete($picture->path);
    //             $picture->delete();
    //         }
    //         foreach ($request->file('picture') as $file) {
    //             $path = $file->store($directory);
    //             $picture = new Picture([
    //                 'path' => $path,
    //             ]);
    //             $touristAttractions->pictures()->save($picture);
    //         }
    //     }
    //     // $picture = [];
    //     // $files = Storage::allFiles($directory);

    //     // foreach ($files as $file) {
    //     //     $url = Storage::url($file);
    //     //     $pictures[] = $url;
    //     // }

    //     return redirect()->route('touristAttractions.index');
    // }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'ta_name' => 'required',
            'ta_desc' => 'required',
            'ta_facilities' => 'required',
            'id_tourism_category' => 'required',
            // 'picture' => 'nullable|array',
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
            // $touristAttractions->picture = json_encode($images);
        } else {
            $directory = 'touristAttractions/' . $id;
        }
        // if ($request->hasFile('picture')) {
        //     $directory = 'touristAttractions/' . $id;
        //     $files = $request->file('picture');
        //     $images = [];
        //     foreach ($files as $file) {
        //         $imageName = $id . '_' . $file->getClientOriginalName();
        //         Storage::putFileAs($directory, $file, $imageName, false);
        //         // Picture::store($file, $directory, $touristAttractions, false);
        //         $images[] = $imageName;
        //     }
        //     $touristAttractions->picture = json_encode($images);
        //     // } else {
        //     //     $directory = 'touristAttractions/' . $id;
        // }

        // $pictures = array();
        // $files = Storage::allFiles($directory);

        // foreach ($files as $file) {
        //     $url = Storage::url($file);
        //     $pictures[] = $url;
        // }
        // $touristAttractions->picture = json_encode($pictures);
        $touristAttractions->save();
        // if ($request->hasFile('picture')) {

        //     foreach ($touristAttractions->pictures as $picture) {
        //         // Storage::delete($picture->path);
        //         $picture->delete();
        //     }
        //     foreach ($request->file('picture') as $file) {
        //         $filename = $touristAttractions->id . '_' . $file->getClientOriginalName();
        //         $directory = 'public/touristAttractions/' . $touristAttractions->id;
        //         $path = $file->storeAs($directory, $filename);
        //         $picture = new Picture([
        //             'path' => $path,
        //         ]);
        //         $touristAttractions->pictures()->save($picture);
        //     }
        // }
        // if (session('page')) {
        //     return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        // }
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

    public function show($id)
    {
        $touristAttractions = TouristAttraction::with('pictures')->find($id);
        return view('/touristAttractions/show', compact('touristAttractions'));
    }
}
