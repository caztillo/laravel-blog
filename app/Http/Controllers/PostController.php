<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Services\PostService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    protected $postService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostService $postService)
    {
        $this->middleware('auth');
        $this->postService = $postService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = $this->postService->getPosts(5);
  
        return view('posts.index',compact('posts'))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        $post = $this->postService->create($request->all());

        if(!$post)
        {
            return redirect()->route('posts.index')
                        ->with('message-type', 'danger')
                        ->with('message','Post cannot be created');
        }

        return redirect()->route('posts.index')
                        ->with('message-type', 'success')
                        ->with('message','Post created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = $this->postService->find($id);
        if(!$post)
        {
            return redirect()->route('posts.index');
        }

        return view('posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = $this->postService->find($id);
        if(!$post)
        {
            return redirect()->route('posts.index');
        }
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        //
        $update = $this->postService->update($request->all());

        if(!$update)
        {
            return redirect()->route('posts.index')
                        ->with('message-type', 'danger')
                        ->with('message','Post cannot be updated');
        }

        return redirect()->route('posts.index')
                        ->with('message-type', 'success')
                        ->with('message','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete = $this->postService->delete($id);

        if(!$delete)
        {
            return redirect()->route('posts.index')
                        ->with('message-type', 'danger')
                        ->with('message','Post cannot be deleted');
        }
        
        return redirect()->route('posts.index')
                        ->with('message-type', 'success')
                        ->with('message','Post deleted successfully');
    }

    /**
     * Search tags given a query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getTags(Request $request)
    {
        $query = $request->input('q');
        $tags = $this->postService->getTags($query);

        return response()->json(['results' => $tags], 200);
    }
}
