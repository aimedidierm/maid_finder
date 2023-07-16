<?php

namespace App\Http\Controllers;

use App\Models\Maid;
use Illuminate\Http\Request;

class MaidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maids = Maid::all();
        return view('index', ['data' => $maids]);
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
    public function show(Maid $maid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maid $maid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maid $maid)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maid $maid)
    {
        //
    }
}
