<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PDF;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->paginate(10);
        return view('employees.index', compact('employees'));
    }

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
        $users = User::all();
        $addedIds = Employee::pluck('id_user')->toArray();
        return view('employees.create', compact('users', 'addedIds'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'name' => 'required',
            'id_user' => 'required|exists:users,id',
            'address' => 'required',
            'phone' => 'required|min:11|max:13',
            'jobtitle' => 'required'
        ]);
        Employee::create($request->all());
        return redirect('/employees')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $employees = Employee::find($id);
        $users = User::all();
        return view('employees.edit', compact('employees', 'users'));
    }

    public function update(Request $request, $id)
    {
        Employee::find($id)->update($request->all());
        // if (session('page')) {
        //     return Redirect::to(session('page'))->with('success', 'Data berhasil diubah!');
        // }
        return redirect('/employees')->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        Employee::find($id)->delete();
        return redirect('/employees')->with('success', 'Data berhasil dihapus!');
    }

    public function export()
    {
        // return 'berhasil';
        $employees = Employee::all();
        view()->share('employees', $employees);
        $pdf = PDF::loadView('laporan-pdf');
        return $pdf->download('laporan.pdf');
        // $pdf = \PDF::loadView('employees/export', compact('employees'));
        // return $pdf->download('employees.pdf');
    }
}
