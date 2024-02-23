<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;


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
        } else {
            // Alerta de erro
            Session::flash('error', 'Erro ao enviar o arquivo. Por favor, tente novamente.');
        }

        return redirect()->back();
    }
}
