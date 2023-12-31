<?php

namespace App\Http\Controllers;

use App\Models\Maid;
use App\Models\MaidRequest;
use App\Models\Payment;
use App\Services\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Paypack\Paypack;

class MaidRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = MaidRequest::latest()->get();
        $request->load('users', 'maids');
        return view('admin.requests', ['data' => $request]);
    }

    public function pending()
    {
        $request = MaidRequest::latest()->where('status', 'payed')->get();
        $request->load('users', 'maids');
        return view('admin.pending', ['data' => $request]);
    }

    public function approved()
    {
        $request = MaidRequest::latest()->where('status', 'approved')->get();
        $request->load('users', 'maids');
        return view('admin.approved', ['data' => $request]);
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
        $request->validate(
            [
                'maid' => 'required|numeric',
                'phone' => 'required|numeric|regex:/^07\d{8}$/',
                'description' => 'required|string',
            ],
            [
                'phone.regex' => 'The phone number must start with "07" and be 10 digits long.',
            ]
        );
        $fee = 100;
        $maid = Maid::find($request->maid);
        $token = Str::random(10);
        if ($maid != null) {
            $maidRequest = new MaidRequest;
            $maidRequest->description = $request->description;
            $maidRequest->user_id = Auth::id();
            $maidRequest->maid_id = $request->maid;
            $maidRequest->status = 'payed';
            $maidRequest->created_at = now();
            $maidRequest->updated_at = null;
            $maidRequest->save();
            $paypackInstance = $this->paypackConfig()->Cashin([
                "amount" => $fee,
                "phone" => $request->phone,
            ]);

            $payment = new Payment;
            $payment->phone = $request->phone;
            $payment->amount = $fee;
            $payment->user_id = Auth::id();
            $payment->maid_request_id = $maidRequest->id;
            $payment->status = 'payed';
            $payment->token = $token;
            $payment->created_at = now();
            $payment->updated_at = null;
            $payment->save();
            // send payment request
            return redirect('/employer');
        } else {
            return redirect('/employer')->withErrors('Maid not found');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MaidRequest $maidRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaidRequest $maidRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaidRequest $maidRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MaidRequest $maidRequest)
    {
        $maidRequest->status = 'closed';
        $maidRequest->update();
        return redirect('/admin/pending');
    }

    public function approve(MaidRequest $maidRequest)
    {
        $maid = Maid::find($maidRequest->maid_id);
        $maid->openToWork = false;
        $maid->update();
        $maidRequest->status = 'approved';
        $maidRequest->update();
        $message = "Dear employer " . $maidRequest->users->name . " your maid request had been approved.";
        $sms = new Sms();
        $sms->recipients([$maidRequest->users->phone])
            ->message($message)
            ->sender(env('SMS_SENDERID'))
            ->username(env('SMS_USERNAME'))
            ->password(env('SMS_PASSWORD'))
            ->apiUrl("www.intouchsms.co.rw/api/sendsms/.json")
            ->callBackUrl("");
        $sms->send();
        return redirect('/admin/pending');
    }

    public function employerList()
    {
        $request = MaidRequest::latest()->where('user_id', Auth::id())->get();
        $request->load('users', 'maids');
        return view('employer.request', ['data' => $request]);
    }

    public function paypackConfig()
    {
        $paypack = new Paypack();

        $paypack->config([
            'client_id' => env('PAYPACK_CLIENT_ID'),
            'client_secret' => env('PAYPACK_CLIENT_SECRET'),
        ]);

        return $paypack;
    }
}
