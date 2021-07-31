<?php

namespace App\Http\Controllers\Api;

use App\Actions\Follow;
use App\Actions\Unfollow;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserFollowController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users/{username}/follow",
     *     summary="Unfollow a user account",
     *     operationId="createUserFollow",
     *     tags={"user","groups"},
     *     @OA\Parameter(
     *         description="User account username",
     *         in="path",
     *         name="username",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *          example="johnsmith"
     *         )
     *     ),
     *     @OA\Response(
     *        response=204,
     *        description="Successful follow association"
     *     ),
     *     @OA\Response(
     *        response=422,
     *        description="Action unsuccessful",
     *        @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example="false")
     *        )
     *     )
     * )
     */
    public function store(User $user): JsonResponse
    {
        if ($user->is(auth()->user())) {
            return response()->json([
                'success' => false,
            ], 406);
        }
        (new Follow())($user);

        return response()->json(null, 204);
    }

    /**
     * @OA\Delete(
     *     path="/users/{username}/follow",
     *     summary="Unfollow a user account",
     *     operationId="deleteUserFollow",
     *     tags={"user","groups"},
     *     @OA\Parameter(
     *         description="User account username",
     *         in="path",
     *         name="username",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *          example="johnsmith"
     *         )
     *     ),
     *     @OA\Response(
     *        response=204,
     *        description="Successful unfollow association"
     *     ),
     *     @OA\Response(
     *        response=422,
     *        description="Action unsuccessful",
     *        @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example="false")
     *        )
     *     )
     * )
     */
    public function delete(User $user): JsonResponse
    {
        (new Unfollow())($user);

        return response()->json(null, 204);
    }
}
