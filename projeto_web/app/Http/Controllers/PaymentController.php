<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PaymentType;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        try {
            $payments = Payment::all();
            $paymentTypes = PaymentType::all();
            $clients = Client::all();
            Log::info(Auth::user()->name . ' acessou os pagamentos');
            return view('payments', compact('payments', 'paymentTypes', 'clients'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request)
    {
        try {
            Payment::create($request->all());
            Log::info('Pagamento ' . ' foi cadastrado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->route('payments.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->update($request->all());
            Log::info('Pagamento ' . $request->name . ' foi atualizado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->route('payments.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $payment = Payment::findOrFail($id);
            $payment->delete();
            Log::info('Pagamento ' . $payment->name . ' foi deletado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->route('payments.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
