<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Client;


class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::all();
        $paymentTypes = PaymentType::all();
        $clients = Client::all();
        return view('payments', compact('payments', 'paymentTypes', 'clients'));
    }

    public function store(Request $request)
    {
        Payment::create($request->all());
        return redirect()->route('payments.index');
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update($request->all());
        return redirect()->route('payments.index');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('payments.index');
    }
}
