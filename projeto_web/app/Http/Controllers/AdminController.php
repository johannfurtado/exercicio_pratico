<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $files = File::all();
            Log::info(Auth::user()->name . ' acessou a página de administração');
            return view('archive', compact('files'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function approve($id, $name)
    {
        try {
            $file = File::findOrFail($id);
            $file->status = 'approved';
            $file->save();
            Log::info('Arquivo ' . $name . ' foi aprovado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function reject($id, $name)
    {
        try {
            $file = File::findOrFail($id);
            $file->status = 'rejected';
            $file->save();
            Log::info('Arquivo ' . $name . ' foi rejeitado por ' . Auth::user()->name . ' com sucesso.');
            return redirect()->back();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
