<?php
    
    namespace App\Http\Controllers;
    
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use function response;
    
    class UserController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index(): Response
        {
            return response([
                'data' => User::all(),
            ]);
        }
        
        
        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         * @return Response
         */
        public function store(Request $request): Response
        {
            return new Response('User created');
        }
        
        
        /**
         * Display the specified resource.
         *
         * @param User $user
         * @return Response
         */
        public function show(User $user): Response
        {
            return response([
                'data' => $user,
            ]);
        }
        
        
        /**
         * Update the specified resource in storage.
         *
         * @param Request $request
         * @param User $user
         * @return Response
         */
        public function update(Request $request, User $user): Response
        {
            return new Response('User updated');
        }
        
        
        /**
         * Remove the specified resource from storage.
         *
         * @param User $user
         * @return Response
         */
        public function destroy(User $user): Response
        {
            return new Response('User deleted');
        }
    }