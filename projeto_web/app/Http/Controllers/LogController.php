<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function downloadLogs()
    {
        $filePath = storage_path('logs/laravel.log');

        if (File::exists($filePath)) {
            Log::info(Auth::user()->name . ' baixou o arquivo de log.');
            return response()->download($filePath);
        } else {
            Log::error(Auth::user()->name . ' tentou baixar o arquivo de log, mas o arquivo não foi encontrado.');
            return response()->json(['error' => 'Arquivo de log não encontrado.'], 404);
        }
    }
}
