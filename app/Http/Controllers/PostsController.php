<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // $posts = DB::select('SELECT * FROM posts WHERE coursecode = ?', ['CSC 111']);

        $posts =  Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'matricnumber' => 'required',
            'coursecode' => 'required',
            'department' => 'required',
            'faculty' => 'required',
            'email' => 'required',
            // 'cover_image' => 'image|nullable|max:1900'
            'file' => 'required|mimes:jpeg,png,jpg,zip,pdf|max:2048'
        ]);

        // HANDLE FILE UPLOAD
        if($request->hasFile('file')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('file')->storeAs('public/files', $fileNameToStore);
        }
        else {
            $fileNameToStore = 'nofile.pdf';
        }

        // Submit Assignment
        $post = new Post;
        $post->fullname = $request->input('fullname');
        $post->matricnumber = $request->input('matricnumber');
        $post->coursecode = $request->input('coursecode');
        $post->department = $request->input('department');
        $post->faculty = $request->input('faculty');
        $post->email = $request->input('email');
        $post->file = $fileNameToStore;
        $post->save();

        // return redirect('/posts')->with('success', 'Assignment Submitted');
        switch ($request->submitbutton) {
            case 'Admin Submit':
                return redirect('/posts')->with('success', 'Assignment Submitted');
                break;
            case 'Submit':
                return redirect('/')->with('success', 'Assignment Submitted');
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fullname' => 'required',
            'matricnumber' => 'required',
            'coursecode' => 'required',
            'department' => 'required',
            'faculty' => 'required',
            'email' => 'required'
        ]);

        // HANDLE FILE UPLOAD
        if($request->hasFile('file')) {
        // Get filename with the extension
        $filenameWithExt = $request->file('file')->getClientOriginalName();
        // Get just filename
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        // Get just ext
        $extension = $request->file('file')->getClientOriginalExtension();
        // Filename to store
        $fileNameToStore = $filename.'_'.time().'.'.$extension;
        // Upload image
        $path = $request->file('file')->storeAs('public/files', $fileNameToStore);
        }

        // Submit Assignment
        $post = Post::find($id);
        $post->fullname = $request->input('fullname');
        $post->matricnumber = $request->input('matricnumber');
        $post->coursecode = $request->input('coursecode');
        $post->department = $request->input('department');
        $post->faculty = $request->input('faculty');
        $post->email = $request->input('email');
        if($request->hasFile('file')) {
            // Delete current file
            Storage::delete('public/files/'.$post->file);
            // Store new file
            $post->file = $fileNameToStore;
        }
        $post->save();

        // return redirect('/posts')->with('success', 'Assignment Updated');
        switch ($request->submitbutton) {
            case 'Admin Submit':
                return redirect('/posts')->with('success', 'Assignment Updated');
                break;
            case 'Submit':
                return redirect('/')->with('success', 'Assignment Updated');
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if($post->file != 'nofile.pdf') {
            // Delete image
            Storage::delete('public/files/'.$post->file);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Assignment Removed');
    }
}
