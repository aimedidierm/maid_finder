<?php

namespace App\Http\Controllers;

use App\Models\Maid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MaidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maids = Maid::all();
        return view('admin.maids', ['data' => $maids]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $maids = Maid::where('openToWork', true)->get();
        return view('index', ['data' => $maids]);
    }

    public function employerList()
    {
        $maids = Maid::where('openToWork', true)->get();
        return view('employer.maids', ['data' => $maids]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'price' => 'required|numeric',
            'address' => 'required|string',
            'gender' => 'required|in:male,female',
            'description' => 'required|string',
            'photo' => 'required|mimes:png,jpg'
        ]);
        $uniqueid = uniqid();
        $extension = $request->file('photo')->getClientOriginalExtension();
        $filename = Carbon::now()->format('Ymd') . '_' . $uniqueid . '.' . $extension;
        $file = $request->file('photo');
        Storage::disk('public')->put($filename, file_get_contents($file));
        $fileUrl = Storage::url($filename);
        $maid = new Maid;
        $maid->name = $request->name;
        $maid->phone = $request->phone;
        $maid->price = $request->price;
        $maid->address = $request->address;
        $maid->gender = $request->gender;
        $maid->description = $request->description;
        $maid->openToWork = true;
        $maid->photo = $fileUrl;
        $maid->save();
        return redirect('/admin');
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
        if ($maid != null) {
            $maid->delete();
            return redirect('/admin');
        } else {
            return redirect('/admin')->withErrors('Maid not found');
        }
    }
}
