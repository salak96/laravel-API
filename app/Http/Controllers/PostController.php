<?php

namespace App\Http\Controllers;

//import database Model post
use App\Models\Post;
//import resource PostResource
use App\Http\Resources\PostResource;

//import Http request
use Illuminate\Http\Request;
//import facade Storage
use Illuminate\Support\Facades\Storage;
//import facade Validator
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a get
     */
    public function index()
    {
        //respon get all
        $posts = Post::latest()->paginate(5);
        return new PostResource(true, 'List Data Posts', $posts);
    }


    /**
     * POST.
     */
    public function store(Request $request)
    {
        
        //define validation rules DATABASE
        $validator = Validator::make($request->all(), [
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title'     => 'required',
            'content'   => 'required',
        ]);
         //check if validation fail JIKA DATA GAGAL
         if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'image'     => $image->hashName(),
            'title'     => $request->title,
            'content'   => $request->content,
        ]);
        return new PostResource(true, 'Data Post Berhasil', $post);
    }

    /**
     * GET BY ID
     */
    public function show($id)
    {
         //find post by ID
         $post = Post::find($id);

         //return single post as a resource
         return new PostResource(true, 'Detail Data Post!', $post);
    }

    

    /**
     * EDIT
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $post = Post::find($id);

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            //delete old image
            Storage::delete('public/posts/' . basename($post->image));

            //update post with new image
            $post->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        } else {

            //update post without image
            $post->update([
                'title'     => $request->title,
                'content'   => $request->content,
            ]);
        }

        //return response
        return new PostResource(true, 'Data Post Berhasil Diubah!', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    //find post by ID
    $post = Post::find($id);

    //delete image
    Storage::delete('public/posts/'.basename($post->image));

    //delete post
    $post->delete();

    //return response
    return new PostResource(true, 'Data Post Berhasil Dihapus!', null);
    }
}