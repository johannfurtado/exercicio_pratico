<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class ClientController extends Controller
{

    public function index()
    {
        try {
            $clients = Client::all();
            Log::info(Auth::user()->name . ' acessou os clientes');
            return view('clients', compact('clients'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function store(Request $request)
    {
        try {
            Client::create($request->all());
            Log::info('Cliente ' . ' foi cadastrado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->route('clients.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->update($request->all());
            Log::info('Cliente ' . $request->name . ' foi atualizado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->route('clients.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(string $id)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            Log::info('Cliente ' . $client->name . ' foi deletado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->route('clients.index');
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
