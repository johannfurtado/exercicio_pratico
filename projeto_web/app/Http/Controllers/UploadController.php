<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Console\View\Components\Info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;


class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showUploadForm()
    {
        Log::info(Auth::user()->name . ' acessou a página de upload');
        return view('upload');
    }

    public function upload(Request $request)
    {

        $user = Auth::user();
        $file = $request->file('file');

        if ($file->isValid()) {
            $path = Storage::disk('public')->put('files', $file);

            $fileModel = new File([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
                'user_id' => $user->id,
            ]);

            $fileModel->save();

            // Alerta de sucesso
            Session::flash('success', 'Arquivo enviado com sucesso!');
            Info(Auth::user()->name . ' enviou o arquivo ' . $file->getClientOriginalName() . ' com sucesso.');
        } else {
            // Alerta de erro
            Session::flash('error', 'Erro ao enviar o arquivo. Por favor, tente novamente.');
            Log::error(Auth::user()->name . ' tentou enviar o arquivo ' . $file->getClientOriginalName() . ' mas ocorreu um erro.');
        }

        return redirect()->back();
    }
}
