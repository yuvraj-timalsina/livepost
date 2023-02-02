<?php

    namespace App\Http\Controllers;

    use App\Events\Models\User\UserCreated;
    use App\Http\Resources\UserResource;
    use App\Models\User;
    use App\Repositories\UserRepository;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;

    class UserController extends Controller
    {
        public function index(Request $request)
        {
            event(new UserCreated(uUser::factory()->make()));
            $users = User::query()->paginate($request->page_size ?? 20);

            return UserResource::collection($users);
        }

        public function store(Request $request, UserRepository $repository)
        {
            $created = $repository->create($request->only([
                'name',
                'email',
            ]));

            return new UserResource($created);
        }

        public function show(User $user)
        {
            return new UserResource($user);
        }

        public function update(Request $request, User $user, UserRepository $repository)
        {
            $user = $repository->update($user, $request->only([
                'name',
                'email',
            ]));

            return new UserResource($user);
        }

        public function destroy(User $user, UserRepository $repository)
        {
            $deleted = $repository->forceDelete($user);

            return new JsonResponse([
                'data' => 'success',
            ]);
        }
    }
