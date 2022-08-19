<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Events\UserCreated;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return PostResource | JsonResponse
     */
    public function index()
    {
        $post = Post::query()->get();
        return PostResource::collection($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePostRequest $request)
    {
        dump('new');
        $post = Post::query()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return response()->json(['data'=> 'Data has been saved', 'post'=>$post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Post $post)
    {
        return response()->json(['data'=> $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $update= $post->update([
            'title' => $request->title ?? $post->title,
            'body' => $request->body ?? $post->body,
        ]);

        if(!$update){
            return response()->json(['error'=>'Field to update data'], 400);
        }else{
            return response()->json(['data' => $post]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Post $post)
    {
        $delete = $post->forceDelete();
        if(!$delete){
            return response()->json(['error'=> 'The post was not deleted'], 400);
        }else{
            return response()->json(['success']);
        }
    }
}