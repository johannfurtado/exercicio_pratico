<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Client;
use App\Models\PaymentType;
use Illuminate\Support\Facades\DB;


class IndicatorController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        $paymentTypes = PaymentType::all();
        $payments = Payment::all();

        $totalClients = $clients->count();
        $totalPayments = $payments->count();
        $totalAmount = $payments->sum('value');

        $totalByPaymentType = DB::table('payment_types')
            ->leftJoin('payments', 'payment_types.id', '=', 'payments.type_id')
            ->select('payment_types.name', DB::raw('COALESCE(SUM(payments.value), 0) as total'))
            ->groupBy('payment_types.name')
            ->get();

        return view('indicators', compact('clients', 'paymentTypes', 'payments', 'totalClients', 'totalPayments', 'totalAmount', 'totalByPaymentType'));
    }
}
