<?php

namespace App\Http\Controllers;

// use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use PDF;


class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // $addedIds = User::pluck('name')->toArray();
        if ($request->has('search')) {
            $employees = User::where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $employees = User::paginate(5);
            Session::put('page', request()->fullUrl());
        }
        return view('employees.index', compact('employees'));
    }

    // public function index()
    // {
    //     $employees = Employee::with('user')->paginate(10);
    //     return view('employees.index', compact('employees'));
    // }

    // public function index(Request $request)
    // {
    //     if ($request->has('search')) {
    //         $employees = Employee::join('users', 'employees.id_user', '=', 'users.id')
    //             ->where('users.name', 'LIKE', '%' . $request->search . '%')
    //             ->paginate(5);
    //         Session::put('page', request()->fullUrl());
    //     } else {
    //         $employees = Employee::join('users', 'employees.id_user', '=', 'users.id')->paginate(5);
    //         Session::put('page', request()->fullUrl());
    //     }
    //     return view('employees/index', compact('employees'));
    // }

    // public function index(Request $request)
    // {
    //     if ($request->has('search')) {
    //         $employees = Employee::where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
    //         Session::put('page', request()->fullUrl());
    //     } else {
    //         $employees = Employee::paginate(5);
    //         Session::put('page', request()->fullUrl());
    //     }
    //     // $employees = Employee::all();
    //     return view('employees/index', compact('employees'));
    // }

    public function create()
    {
        // $users = User::all();
        // $addedIds = Employee::pluck('id_user')->toArray();
        return view('employees.create');
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

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => $request->level,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        // $this->validate($request, [
        //     // 'name' => 'required',
        //     'id_user' => 'required|exists:users,id',
        //     'address' => 'required',
        //     'phone' => 'required|min:11|max:13',
        //     'jobtitle' => 'required'
        // ]);
        // Employee::create($request->all());
        return redirect()->route('employees.index')->with('success', 'Karyawan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $employees = User::find($id);
        return view('employees/edit', compact('employees'));
    }

    public function update(Request $request, $id)
    {
        User::find($id)->update($request->all());
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        }
        return redirect('/employees')->with('success', 'Data berhasil diubah!');
    }
    // public function edit($id)
    // {
    //     $employees = Employee::find($id);
    //     $users = User::all();
    //     return view('employees.edit', compact('employees', 'users'));
    // }

    // public function update(Request $request, $id)
    // {
    //     Employee::find($id)->update($request->all());
    //     // if (session('page')) {
    //     //     return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
    //     // }
    //     return redirect('/employees')->with('success', 'Data berhasil diubah!');
    // }

    // public function destroy($id)
    // {
    //     Employee::find($id)->delete();
    //     return redirect('/employees')->with('success', 'Data berhasil dihapus!');
    // }

    public function destroy($id)
    {
        User::find($id)->delete();
        if (session('page')) {
            return Redirect::to(session('page'))->with('success', 'Data berhasil dihapus!');
        }
        return redirect('/employees')->with('success', 'Data berhasil dihapus!');
    }

    public function export()
    {
        // return 'berhasil';
        $employees = User::all();
        view()->share('employees', $employees);
        $pdf = PDF::loadView('laporan-pdf');
        return $pdf->download('laporan.pdf');
        // $pdf = \PDF::loadView('employees/export', compact('employees'));
        // return $pdf->download('employees.pdf');
    }
}
