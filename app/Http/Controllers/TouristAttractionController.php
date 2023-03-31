<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TouristAttraction;
use App\Models\TourismCategory;
use App\Models\Picture;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class TouristAttractionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $touristAttractions = TouristAttraction::where('ta_name', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $touristAttractions = TouristAttraction::paginate(5);
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
            'id_picture' => 'nullable|array',
            'id_picture.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $touristAttractions = TouristAttraction::create($request->all());

        if ($request->hasFile('id_picture')) {
            $pictures = [];
            foreach ($request->file('id_picture') as $file) {
                $name = $file->getClientOriginalName();
                $file->storeAs('public/foto', $name);
                $pictures[] = new Picture(['file_name' => $name]);
            }
            $touristAttractions->pictures()->saveMany($pictures);
        }
        return redirect('/touristAttractions')->with('success', 'Data berhasil ditambahkan!');
    }
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
