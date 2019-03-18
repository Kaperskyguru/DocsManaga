<?php

namespace App\Http\Controllers;

use App\Document;
use App\File;
use App\Link;
use App\Log as Logs;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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
        return view('dashboard.index', [
            'documents' => Document::limit(5)->orderBy('id', 'desc')->get(),
            'totalDocuments' => Document::all()->count(),
            'totalUsers' => User::all()->count(),
            'totalLinks' => Link::all()->count(),
        ]);
    }

    /**
     * Show the application user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        return view('dashboard.users')->with('users', User::orderBy('created_at', 'desc')->get());
    }

    /**
     * Show the application log dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function logs()
    {
        return view('dashboard.logs')->with('logs', Logs::orderBy('created_at', 'asc')->get());
    }

    /**
     * Show the application documents dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function documents()
    {
        return view('dashboard.documents', [
            'documents' => Document::orderBy('created_at', 'desc')->get(),
            'trashes' => Document::onlyTrashed()->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function addDocuments(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required',
            'category' => 'required',
            'access' => 'required|integer',
            'file' => 'required',
        ]);

        $document = new Document;
        $document->title = $request->title;
        $document->description = $request->description;
        $document->filename = $request->file->store('documents');
        $document->file = $request->file('file')->getClientOriginalName();
        $document->type = $request->file('file')->getClientOriginalExtension();
        $document->access = $request->access;
        $document->user_id = Auth::user()->id;
        $document->category = $request->category;
        if ($document->save()) {
            log::info('Adding new document successfully:');
            return redirect()->route('documents')->with('success', 'Document uploaded successfully');
        }
        log::error('Adding new document failed:');
    }

    public function addUser(Request $request)
    {

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'integer'],
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        if ($user->save()) {
            log::info('Adding new user successfully:');
            return redirect()->route('users')->with('success', 'User Registered successfully');
        }
        log::error('Adding new user failed:');
    }

    public function approveUser(Request $request)
    {
        if ($request->ajax()) {
            
            $user = User::find($request->id);
            $user->status = $request->status;
            if ($user->save()) {
                if ($request->status == 2) {
                    log::info('User successfully Approved:');
                    return '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    User successfully Approved </div>
                ';
                } else {
                    log::info('User successfully Disappoved:');
                    return '
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    User successfully Disappoved </div>
                ';

                }
            }

            log::error('User approval failed:');
        }

    }

    public function updateDocument($id, Request $request)
    {
        $validator = $request->validate([
            "title" => 'string',
            "access" => 'string',
            "category" => 'string',
            "type" => 'numeric',
        ]);

        $data = $request->all();
        unset($data['_token']);
        unset($data['_method']);
        if (Document::whereId($id)->update($data)) {
            log::info('Document successfully Updated:');
            return back()->with('success', 'Document successfully Updated!');
        }
        log::error('Document failed to Updated:');
    }

    public function displayUpdateBox(Request $request)
    {
        if ($request->ajax()) {
            $document = Document::findOrFail($request->id);
            return view('dashboard.editBox', ['document' => $document])->render();
        }

    }

    public function clearLogs()
    {
        $log = new Logs;
        if ($log->truncate()) {
            log::info('Log successfully cleared:');
            return back()->with('success', 'Log successfully cleared!');
        }
        log::info('Log failed to cleared:');
    }

    public function displayLinkBox(Request $request)
    {
        if ($request->ajax()) {

            //Select Link from Links with document
            $link = Link::where('document_id', $request->id)->first();

            if (empty($link)) {

                //generate url
                $encodedFilename = bin2hex(random_bytes(10));
                $url = url('/') . '/share/' . $encodedFilename;

                //store the url in database
                $link = new Link;
                $link->document_id = $request->id;
                $link->user_id = Auth::user()->id;
                $link->link = $encodedFilename;

                //Display link to pop up box
                if ($link->save()) {
                    log::info('Link successfully generated:');
                    return view('dashboard.shareBox', ['url' => $url])->render();
                }
            } else {
                $url = url('/') . '/share/' . $link->link;
                return view('dashboard.shareBox', ['url' => $url])->render();
            }
            log::error('Link failed to generated:');
        }
    }

    public function deleteUser($id)
    {
        if (User::findOrfail($id)->delete()) {
            log::info('User successfully deleted:');
            return '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                User successfully deleted</div>
            ';
        }
        log::error('User failed to delete:');
    }

    public function trashDocument($id)
    {
        if (Document::findOrfail($id)->delete()) {
            log::info('Document successfully deleted:');
            return '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Document trashed successfully </div>
            ';
        }
        log::error('Document failed to delete:');
    }

    public function restoreTrashDocument($id)
    {
        if (Document::withTrashed()->findOrfail($id)->restore()) {
            log::info('Trashed document successfully restored:');
            return '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Trashed document successfully restored</div>
            ';
        }
        log::error('Trashed document failed restore:');
    }

    public function deleteDocument($id)
    {

        if (Document::withTrashed()->findOrfail($id)->forceDelete()) {
            log::info('Document successfully permanently deleted:');
            return '
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Document successfully permanently deleted</div>
            ';
        }
        log::error('Document failed to permanently delete:');
    }

    public function download($name)
    {
        if (Storage::disK('local')->exists('documents/' . $name)) {
            $document = Document::where('filename', 'documents/' . $name)->first();
            log::info('Successfully downloaded a document:');
            return Storage::download('documents/' . $name, $document->file);
        } else {
            log::info('Document not exist to download:');
            return back();
        }
    }
}
