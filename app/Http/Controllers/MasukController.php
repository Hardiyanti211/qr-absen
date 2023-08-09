<?php

namespace App\Http\Controllers;

use App\Models\Masuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Absen Masuk';
        $masuk = DB::table('masuk')
        ->join('users', 'masuk.id_user', 'users.id')
        ->orderByDesc('masuk.id_masuk')
        ->get();
        return view('masuk.index', compact('title', 'masuk'));
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
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Masuk $masuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Masuk $masuk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Masuk $masuk)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Masuk $masuk)
    {
        //
    }
}
