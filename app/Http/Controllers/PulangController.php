<?php

namespace App\Http\Controllers;

use App\Models\Pulang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PulangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Absen pulang';
        $pulang = DB::table('pulang')
        ->join('users', 'pulang.id_user', 'users.id')
        ->orderByDesc('pulang.id_pulang')
        ->get();
        return view('pulang.index', compact('title', 'pulang'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pulang $pulang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pulang $pulang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pulang $pulang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pulang $pulang)
    {
        //
    }
}
