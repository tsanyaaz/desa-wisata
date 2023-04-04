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
        if ($request->has('search')) {
            $employees = User::where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);
            Session::put('page', request()->fullUrl());
        } else {
            $employees = User::paginate(5);
            Session::put('page', request()->fullUrl());
        }
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
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
        $employees = User::all();
        view()->share('employees', $employees);
        $pdf = PDF::loadView('laporan-pdf');
        return $pdf->download('laporan.pdf');
    }
}
