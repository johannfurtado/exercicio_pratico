<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
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
    public function index()
    {
        $files = File::all();
        return view('archive', ['files' => $files]);
    }

    public function approve($id, $name)
    {
        $file = File::findOrFail($id);
        $file->status = 'approved';
        $file->save();

        return redirect()->back();
    }

    public function reject($id, $name)
    {
        $file = File::findOrFail($id);
        $file->status = 'rejected';
        $file->save();

        return redirect()->back();
    }
}