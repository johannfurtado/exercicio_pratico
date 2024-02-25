<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;


class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::all();
        return view('clients', compact('clients'));
    }

    public function store(Request $request)
    {
        Client::create($request->all());
        return redirect()->route('clients.index');
    }

    public function update(Request $request, string $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());
        return redirect()->route('clients.index');
    }

    public function destroy(string $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return redirect()->route('clients.index');
    }
}
