<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PDF;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $users = User::where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $users = User::paginate(5);
            Session::put('page', request()->fullUrl());
        }
        // $users = user::all();
        return view('users/index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'level' => 'required|in:Administrator,Bendahara,Pemilik',
            'address' => 'nullable',
            'phone' => 'nullable',
        ]);

        $users = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $users = User::find($id);
        return view('users/edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        User::find($id)->update($request->all());
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/users')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/users')->with('success', 'Data berhasil dihapus!');
    }

    public function activate($id)
    {
        User::find($id)->update(['aktif' => 1]);
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diaktifkan!');
        }
        return redirect('/users')->with('success', 'Data berhasil diaktifkan!');
    }

    public function deactivate($id)
    {
        User::find($id)->update(['aktif' => 0]);
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dinonaktifkan!');
        }
        return redirect('/users')->with('success', 'Data berhasil dinonaktifkan!');
    }

    public function profile()
    {
        $users = User::find(auth()->user()->id);
        return view('users.profile', compact('users'));
    }

    public function editProfile()
    {
        $users = User::find(auth()->user()->id);
        return view('users.editprofile', compact('users'));
    }

    public function updateProfile(Request $request)
    {
        $users = User::find(auth()->user()->id);
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        if ($request->input('password')) {
            $users->password = bcrypt($request->input('password'));
        }
        $users->address = $request->input('address');
        $users->phone = $request->input('phone');

        $users->save();
        return redirect()->route('users.profile')->with('success', 'Data berhasil diubah!');
    }

    // public function profile()
    // {
    //     $users = User::find(auth()->user()->id);
    //     return view('users.profile', compact('users'));
    // }

    // public function editProfile()
    // {
    //     $users = User::find(auth()->user()->id);
    //     return view('users/profile/edit', compact('users'));
    // }

    // public function updateProfile(Request $request)
    // {
    //     User::find(auth()->user()->id)->update($request->all());
    //     if (session('page')) {
    //         return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
    //     }
    //     return redirect('users.profile')->with('success', 'Data berhasil diubah!');
    // }

    // public function export()
    // {
    //     $users = user::all();
    //     view()->share('users', $users);
    //     $pdf = PDF::loadView('laporan-pdf');
    //     return $pdf->download('laporan.pdf');
    // }
}
