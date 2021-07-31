<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\UserUpdate as UserUpdateRequest;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users/{username}",
     *     summary="Retrieve user record",
     *     operationId="readUser",
     *     security={{"bearerAuth": {}}},
     *     tags={"user"},
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
     *        response=200,
     *        description="Successful user record lookup",
     *        @OA\JsonContent(
     *           @OA\Property(property="data", ref="#/components/schemas/User")
     *        )
     *     ),
     *     @OA\Response(
     *        response=404,
     *        description="Record not found",
     *        @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example="false")
     *        )
     *     )
     * )
     */
    public function show(User $user): JsonResource
    {
        return new UserResource($user);
    }

    /**
     * @OA\Patch(
     *     path="/users/{username}",
     *     summary="Update user record",
     *     operationId="readUser",
     *     security={{"bearerAuth": {}}},
     *     tags={"user"},
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
     *     @OA\RequestBody(
     *         required=true,
     *         description="User attributes to update",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Smith"),
     *             @OA\Property(property="email", type="string", example="jsmith@foteaux.io"),
     *             @OA\Property(property="username", type="string", example="jsmith"),
     *         ),
     *     ),
     *     @OA\Response(
     *        response=200,
     *        description="Successful user record update",
     *        @OA\JsonContent(
     *           @OA\Property(property="data", ref="#/components/schemas/User")
     *        )
     *     ),
     *     @OA\Response(
     *        response=404,
     *        description="Record not found",
     *        @OA\JsonContent(
     *           @OA\Property(property="success", type="boolean", example="false")
     *        )
     *     )
     * )
     */
    public function update(User $user, UserUpdateRequest $request): JsonResource
    {
        $user->update($request->only([
            'name',
            'email',
            'username',
        ]));

        return $this->show($user);
    }
}
