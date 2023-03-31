<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        // if ($request->has('search')) {
        //     $reservations = Reservation::where('ta_name', 'LIKE', '%' . $request->search . '%')->paginate(5);
        //     Session::put('page', request()->fullUrl());
        // } else {
        //     $reservations = Reservation::paginate(5);
        //     Session::put('page', request()->fullUrl());
        // }
        $reservations = Reservation::paginate(10);
        return view('reservations/index', compact('reservations'));
    }

    // public function create()
    // {
    //     return view('reservations/create');
    // }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'ta_name' => 'required',
    //         'ta_desc' => 'required',
    //         'ta_facilities' => 'required',
    //     ]);
    //     Reservation::create($request->all());
    //     return redirect('/reservations')->with('success', 'Data berhasil ditambahkan!');
    // }

    // public function edit($id)
    // {
    //     $reservations = Reservation::find($id);
    //     return view('reservations/edit', compact('reservations'));
    // }

    // public function update(Request $request, $id)
    // {
    //     reservation::find($id)->update($request->all());
    //     if (session('page')) {
    //         return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
    //     }
    //     return redirect('/reservations')->with('success', 'Data berhasil diubah!');
    // }

    // public function destroy($id)
    // {
    //     Reservation::find($id)->delete();
    //     if (session('page')) {
    //         return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
    //     }
    //     return redirect('/reservations')->with('success', 'Data berhasil dihapus!');
    // }
}
