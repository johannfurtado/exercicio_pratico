<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentTypeController extends Controller
{
    public function index()
    {
        try {
            $paymentTypes = PaymentType::all();
            Log::info(Auth::user()->name . ' acessou os tipos de pagamento');
            return view('paymentTypes', compact('paymentTypes'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request)
    {
        try {
            PaymentType::create($request->all());
            Log::info('Tipo de pagamento ' . ' foi cadastrado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->route('paymentTypes.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $paymentType = PaymentType::findOrFail($id);
            $paymentType->update($request->all());
            Log::info('Tipo de pagamento ' . $request->name . ' foi atualizado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->route('paymentTypes.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $paymentType = PaymentType::findOrFail($id);
            $paymentType->delete();
            Log::info('Tipo de pagamento ' . $paymentType->name . ' foi deletado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->route('paymentTypes.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
