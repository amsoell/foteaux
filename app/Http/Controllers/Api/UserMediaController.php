<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Media;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserMediaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/users/{username}/media",
     *     summary="Retrieve user media records",
     *     operationId="readUserMedia",
     *     tags={"user", "media"},
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
     *        description="Successful user media records lookup",
     *        @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Media"))
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
    public function index(User $user): AnonymousResourceCollection
    {
        return Media::collection($user->media()->paginate(10));
    }
}
