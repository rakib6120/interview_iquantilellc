<?php

namespace App\Http\Controllers;

use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Video::orderBy('id', 'desc')->paginate(12);
        return view('home', ['data' => $data]);
    }

    public function create()
    {
        return view('create_video');
    }

    public function store(Request $request)
    {
        $request->validate([
            'source' => "required|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv",
            'desc' => "required",
        ]);
        $file = $request->file('source');
        //Move Uploaded File
        $file_name = uniqid() . "_" . $file->getClientOriginalName();
        $destinationPath = 'uploads';
        $file->move($destinationPath, $file_name);

        //save in database
        Video::insert([
            'user_id' => Auth::user()->id,
            'source' => $file_name,
            'desc' => $request->desc,
            'created_at' => Carbon::now(),
        ]);

        return back();
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Video::findOrFail($id);
        return view('edit_video', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'desc' => "required",
        ]);

        $old_data = Video::findOrFail($id);
        $file = $request->file('source');
        if(!empty($file)){
            //Move Uploaded File
            $file_name = uniqid() . "_" . $file->getClientOriginalName();
            $destinationPath = 'uploads';
            $file->move($destinationPath, $file_name);
            unlink(public_path($destinationPath . '/' . $old_data->source));
        }else{
            $file_name = $old_data->source;
        }

        //save in database
        Video::findOrFail($old_data->id)->update([
            'source' => $file_name,
            'desc' => $request->desc,
        ]);

        return back();
    }

    public function destroy($id)
    {
        $data = Video::findOrFail($id);
        unlink(public_path('uploads/' . $data->source));
        $data->delete();
        return back();
    }
}
