<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = DB::table('users')->where('role', '=', 'Karyawan')->orderByDesc('id')->get();
        $title = 'Data Karyawan';
        return view('karyawan.index', compact('title', 'karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Karyawan';
        return view('karyawan.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $data  = new User();
        $data->name     = $request->name;
        $data->password = Hash::make($request->password);
        $data->email = $request->email;
        $data->role = 'Karyawan';
        $data->save();
        return redirect()->route('karyawan.index')->with('Sukses', 'Berhasil Tambah karyawan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawan = User::find($id);
        $title = 'Edit Karyawan';
        return view('karyawan.edit', compact('karyawan', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);
        $data  = User::findorfail($id);
        $data->name     = $request->name;
        $data->email = $request->email;
        $data->role = 'Karyawan';
        if ($request->password != "") {
            $data->password = Hash::make($request->password);
        }
        $data->save();
        return redirect()->route('karyawan.index')->with('Sukses', 'Berhasil Edit Karyawan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Data Karyawan');
    }
}
