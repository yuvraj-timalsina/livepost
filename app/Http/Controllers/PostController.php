<?php
    namespace App\Http\Controllers;
    
    use App\Models\Post;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use App\Http\Requests\UpdatePostRequest;
    
    class PostController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index() : Response
        {
            $posts = Post ::query() -> get();
            
            return response([
                'posts' => $posts,
            ]);
        }
        
        /**
         * Store a newly created resource in storage.
         *
         * @param \App\Http\Requests\StorePostRequest $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request) : ?Response
        {
            $createdPost = Post ::query() -> create([
                'title' => $request -> title,
                'body' => $request -> body,
            ]);
            
            return response([
                'post' => $createdPost,
            ]);
        }
        
        /**
         * Display the specified resource.
         *
         * @param \App\Models\Post $post
         *
         * @return \Illuminate\Http\Response|null
         */
        public function show(Post $post) : ?Response
        {
            return response([
                'post' => $post,
            ]);
        }
        
        /**
         * Update the specified resource in storage.
         *
         * @param \App\Http\Requests\UpdatePostRequest $request
         * @param \App\Models\Post $post
         *
         * @return \Illuminate\Http\Response|null
         */
        public function update(UpdatePostRequest $request, Post $post) : ?Response
        {
            //            $post -> update($request -> only(['title', 'body']));
            $updated = $post -> update([
                'title' => $request -> title ?? $post -> title,
                'body' => $request -> body ?? $post -> body,
            ]);
            if (!$updated) {
                return response([
                    'error' => 'Post not updated!',
                ], 400);
            }
            
            return response([
                'post' => $post,
            ]);
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Models\Post $post
         *
         * @return \Illuminate\Http\Response|null
         */
        public function destroy(Post $post) : ?Response
        {
            $deleted = $post -> forceDelete();
            if (!$deleted) {
                return response([
                    'error' => 'Post not deleted!',
                ], 400);
            }
            
            return response([
                'data' => 'Post deleted!',
            ]);
        }
    }
