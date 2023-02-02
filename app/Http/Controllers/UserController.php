<?php

    namespace App\Http\Controllers;

    use App\Http\Resources\PostResource;
    use App\Http\Resources\UserResource;
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
        public function index() : Response
        {
            $pageSize = request()->page_size ?? 20;
            $users = User::paginate($pageSize);

            return UserResource::collection($users);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         *
         * @return Response
         */
        public function store(Request $request) : Response
        {
            $created = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return new PostResource($created);
        }

        /**
         * Display the specified resource.
         *
         * @param User $user
         *
         * @return Response
         */
        public function show(User $user) : Response
        {
            return new UserResource($user);
        }

        /**
         * Update the specified resource in storage.
         *
         * @param Request $request
         * @param User $user
         *
         * @return Response
         */
        public function update(Request $request, User $user) : Response
        {
            $updated = $user->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->email ?? $user->email,
                'password' => $request->password ?? $user->password,
            ]);
            if (!$updated) {
                return response([
                    'error' => 'User not updated!',
                ], 400);
            }

            return new UserResource($user);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param User $user
         *
         * @return Response
         */
        public function destroy(User $user) : Response
        {
            return new Response('User deleted');
        }
    }
