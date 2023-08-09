<?php

namespace App\Http\Controllers;

use App\Models\Masuk;
use App\Models\Pulang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Setting;
use DASPRiD\Enum\AbstractEnum;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = date('Y-m-d');
        $masuk = DB::table('masuk')
        ->join('users', 'masuk.id_user', 'users.id')
        ->where('masuk.tanggal_masuk', $now)
        ->orderByDesc('masuk.id_masuk')
        ->get();
        $pulang = DB::table('pulang')
        ->join('users', 'pulang.id_user', 'users.id')
        ->where('pulang.tanggal_pulang', $now)
        ->orderByDesc('pulang.id_pulang')
        ->get();
        return view('welcome', compact('masuk', 'pulang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $setting = Setting::first();
        $cek = Masuk::where([
            'id_user' => $request->id_user,
            'tanggal_masuk' => date('Y-m-d')
        ])->first();
        if($cek){
            $cek_pulang = Pulang::where([
                'id_user' => $request->id_user,
                'tanggal_pulang' => date('Y-m-d')
            ])->first();
            if($cek_pulang){
                return redirect('/')->with('Gagal', 'Anda Sudah Melakukan Absen Sebelumnya');
            }
            else{
                Pulang::create([
                    'id_user' => $request->id_user,
                    'tanggal_pulang' => date('Y-m-d'),
                    'jam_pulang' => date('H:i:s')
                ]);
                return redirect('/')->with('Sukses', 'Terimakasih, Anda Sudah Berhasil Absen Pulang');
            }
        }
        Masuk::create([
            'id_user' => $request->id_user,
            'tanggal_masuk' => date('Y-m-d'),
            'jam_masuk' => date('H:i:s')
        ]);
        return redirect('/')->with('Sukses', 'Terimakasih, Anda Sudah Berhasil Absen Masuk');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
