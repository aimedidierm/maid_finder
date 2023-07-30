<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\MaidRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::latest()->get();
        $contracts->load('maids');
        $maids = MaidRequest::where('user_id', Auth::id())->where('status', 'approved')->get();
        $unSigned = Contract::where('user_id', Auth::id())->where('status', 'pending')->get();
        $unSigned->load('maids');
        $maids->load('maids');
        if (Auth::user()->role == 'admin') {
            return view('admin.contracts');
        } else {
            return view('employer.contracts', ['data' => $contracts, 'maids' => $maids, 'unSigned' => $unSigned]);
        }
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
        $request->validate([
            'maid' => 'required|numeric',
            'date' => 'required|date'
        ]);
        $contract = new Contract;
        $contract->startDate = $request->date;
        $contract->status = 'pending';
        $contract->user_id = Auth::id();
        $contract->maid_id = $request->maid;
        $contract->created_at = now();
        $contract->updated_at = null;
        $contract->save();
        return redirect('/employer/contracts');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        //
    }

    public function paper($id)
    {
        $contract = Contract::find($id)->load('users', 'maids');
        $today = now();
        $pdf = Pdf::loadView('contract', ['data' => $contract, 'today' => $today]);
        return $pdf->download('contract.pdf');
    }

    public function signed(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:png,jpg,pdf',
            'contract' => 'required|numeric'
        ]);
        $contract = Contract::where('id', $request->contract)->first();
        if ($contract != null) {
            $uniqueid = uniqid();
            $extension = $request->file('file')->getClientOriginalExtension();
            $filename = Carbon::now()->format('Ymd') . '_' . $uniqueid . '.' . $extension;
            $file = $request->file('file');
            Storage::disk('public')->put($filename, file_get_contents($file));
            $fileUrl = Storage::url($filename);
            $contract->status = 'signed';
            $contract->file = $fileUrl;
            $contract->update();
            return back();
        } else {
            return back()->withErrors('Contract not found');
        }
    }
}
