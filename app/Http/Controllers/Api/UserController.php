<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\User as UserResource;
use App\Models\User;

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
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }
}
