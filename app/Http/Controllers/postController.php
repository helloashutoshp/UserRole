<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class postController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);
        return view('admin.posts.list', ['posts' => $posts]);
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        if ($validator->passes()) {
            $post = new Post();
            $post->heading = $req->title;
            $post->description = $req->description;
            $post->save();
            session()->flash('success', 'Successfully post created');
            return response()->json([
                'status' => true,
                'message' => "post created",

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function toggleStatus($id)
    {
        $post = Post::findOrFail($id);
        $post->status = $post->status == 1 ? 0 : 1;
        $post->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post) {
            session()->flash('error', 'post not found');
            return response()->json([
                'status' => false,
                'message' => 'post not found'
            ]);
        }
        $post->delete();
        session()->flash('success', 'Post deleted');
        return response()->json([
            'status' => true,
            'message' => 'deleted'
        ]);
    }

    public function edit($id)
    {
        try {
            $decryptId = Crypt::decrypt($id);
            $post = Post::findOrFail($decryptId);
            return view('admin.posts.edit', ['post' => $post]);
        } catch (DecryptException $e) {
            return redirect()->route('admin.posts')->with('error', 'Invalid URL or post ID.');
        }
    }

    public function update(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        if ($validator->passes()) {
            $post = Post::find($req->post_id);
            $post->heading = $req->title;
            $post->description = $req->description;
            $post->update();
            session()->flash('success', 'Successfully post updated');
            return response()->json([
                'status' => true,
                'message' => "post updated",

            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
