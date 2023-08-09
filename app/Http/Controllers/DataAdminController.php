<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = DB::table('users')->where('role', '=', 'Admin')->orderByDesc('id')->get();
        $title = 'Data Admin';
        return view('data_admin.index', compact('title', 'admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Admin';
        return view('data_admin.create', compact('title'));
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
        $data->role = 'Admin';
        $data->save();
        return redirect()->route('data_admin.index')->with('Sukses', 'Berhasil Tambah Admin');
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
        $admin = User::find($id);
        $title = 'Edit Admin';
        return view('data_admin.edit', compact('title', 'admin'));
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
        $data->role = 'Admin';
        if ($request->password != "") {
            $data->password = Hash::make($request->password);
        }
        $data->save();
        return redirect()->route('data_admin.index')->with('Sukses', 'Berhasil Edit Admin');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::find($id);
        $admin->delete();
        return redirect()->back()->with('Sukses', 'Berhasil Hapus Admin');
    }
}
