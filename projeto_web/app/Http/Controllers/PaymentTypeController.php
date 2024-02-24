<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function index()
    {
        $paymentTypes = PaymentType::all();
        return view('paymentTypes', compact('paymentTypes'));
    }

    public function store(Request $request)
    {
        PaymentType::create($request->all());
        return redirect()->route('paymentTypes.index');
    }

    public function update(Request $request, $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->update($request->all());
        return redirect()->route('paymentTypes.index');
    }

    public function destroy(PaymentType $paymentType)
    {
        $paymentType->delete();
        return redirect()->route('paymentTypes.index');
    }
}
