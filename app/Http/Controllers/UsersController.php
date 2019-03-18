<?php

namespace App\Http\Controllers;

use App\Document;
use App\Link;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('status');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('users.index', [
            'documents' => Document::where('user_id', Auth::user()->id)->limit(5)->orderBy('id', 'desc')->get(),
            'totalDocuments' => Document::where('user_id', Auth::user()->id)->count(),
            'totalLinks' => Link::where('user_id', Auth::user()->id)->get()->count(),
        ]);
    }
    
    /**
     * Show the application documents dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function documents()
    {
        return view('users.documents', [
            'documents' => Document::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get(),
            'trashes' => Document::onlyTrashed()->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get(),
        ]);
    }

}
