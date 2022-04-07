<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = Post::paginate();
        return view('posts.manage', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $sponsor = User::where('role', 'sponsor')->get();
        $orphan = User::where('role', 'orphan')->get();
        return view('posts.create', compact('sponsor', 'orphan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->description;
        $post->orphan_id = $request->orphan_id;
        $post->sponsor_id = $request->sponsor_id;
        if($request->has('image') and $request->image != ''){
            $imageName = $request->image->store('post_images');
            $post->image = $imageName;
        }
        $post->save();
        return response(['result' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        $post = Post::find($post->id);
        $sponsor = User::where('role', 'sponsor')->get();
        $orphan = User::where('role', 'orphan')->get();
        return view('posts.edit', compact('post', 'orphan', 'sponsor'));
    }


    public function update(Request $request, Post $post)
    {
//        dd($request->title);
//        $post = Post::find($post->id);
        $post->title = $request->title;
        $post->content = $request->description;
        $post->orphan_id = $request->orphan_id;
        $post->sponsor_id = $request->sponsor_id;
        if($request->has('image') and $request->image != ''){
            $imageName = $request->image->store('post_images');
            $post->image = $imageName;
        }
        $post->save();

        return response(['result' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response(['result' => 'success']);
    }
    public function publish(Post $post)
    {
        $post->status = 1;
        $post->save();
        return response(['result' => 'success']);
    }
    public function reserve(Post $post)
    {
        $post->paid_by_sponsor_id = auth()->user()->id;
        $post->paid_at = Carbon::now();
        $post->status = 2;
        $post->save();
        return response(['result' => 'success']);
    }
    public function pay(Post $post)
    {
        $post->status = 3;
        $post->save();
        return response(['result' => 'success']);
    }
    public function cancel(Post $post)
    {
        $post->status = 4;
        $post->save();
        return response(['result' => 'success']);
    }

    public function uploadPostImages(Request $request)
    {
        if ($_COOKIE['ckCsrfToken'] == $_POST['ckCsrfToken']) {

            define('KB', 1024);
            define('MB', 1048576);
            define('GB', 1073741824);
            define('TB', 1099511627776);


            //set variables
            $tmpName = $_FILES['upload']['tmp_name'];
            $filename = $_FILES['upload']['name'];
            $size = $_FILES['upload']['size'];
            $data = date('d-m-Y-H-i-s');
            $filePath = public_path() . "/upload/posts/" . $data . '-' . $filename;
            $fileurl = url('/') . "/public/upload/posts/" . $data . '-' . $filename;
            $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            $type = $_GET['type'] ?? 'image';
            $funcNum = isset($_GET['CKEditorFuncNum']) ? $_GET['CKEditorFuncNum'] : null;

            if ($type === 'image') {
                $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png');
            } else {
                //file
                $allowedfileExtensions = array('jpg', 'jpeg', 'gif', 'png', 'pdf', 'doc', 'docx');
            }

            //contrinue only if file is allowed
            if (in_array($fileExtension, $allowedfileExtensions)) {

                //contunie if file is less then the desired size
                if ($size < 20 * MB) {

                    if (move_uploaded_file($tmpName, $filePath)) {


                        $data = ['uploaded' => 1, 'fileName' => $filename, 'url' => $fileurl];

                        if ($type === 'file') {

                            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath');</script>";
                            exit();
                        }

                    } else {

                        $error = 'There has been an error, please contact support.';

                        if ($type == 'file') {
                            $message = $error;

                            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath', '$message');</script>";
                            exit();
                        }

                        $data = array('uploaded' => 0, 'error' => array('message' => $error));

                    }

                } else {

                    $error = 'The file must be less than 20MB';

                    if ($type == 'file') {
                        $message = $error;

                        echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath', '$message');</script>";
                        exit();
                    }

                    $data = array('uploaded' => 0, 'error' => array('message' => $error));

                }

            } else {

                $error = 'The file type uploaded is not allowed.';

                if ($type == 'file') {
                    $funcNum = $_GET['CKEditorFuncNum'];
                    $message = $error;

                    echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($funcNum, '$filePath', '$message');</script>";
                    exit();
                }


                $data = array('uploaded' => 0, 'error' => array('message' => $error));

            }

            //return response
            echo json_encode($data);
        }
    }
}

