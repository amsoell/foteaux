<?php

namespace App\Http\Controllers\Api;

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
     *        description="Successful user media records lookup",
     *        @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Media")),
     *           @OA\Property(property="links", type="array", @OA\Items(
     *               @OA\Property(property="first", type="string", example="https://foteaux.test/api/v1/users/jsmith/media?page=1"),
     *               @OA\Property(property="last", type="string", example="https://foteaux.test/api/v1/users/jsmith/media?page=3"),
     *               @OA\Property(property="prev", type="string", example="https://foteaux.test/api/v1/users/jsmith/media?page=1"),
     *               @OA\Property(property="next", type="string", example="https://foteaux.test/api/v1/users/jsmith/media?page=3")
     *           )),
     *           @OA\Property(property="meta", type="array", @OA\Items(
     *               @OA\Property(property="current_page", type="number"),
     *               @OA\Property(property="from", type="number", example="16"),
     *               @OA\Property(property="last_page", type="number", example="3"),
     *               @OA\Property(property="path", type="string", example="https://foteaux.test/api/v1/users/jsmith/media?page=2"),
     *               @OA\Property(property="per_page", type="number", example="15"),
     *               @OA\Property(property="to", type="number", example="30"),
     *               @OA\Property(property="total", type="number", example="38")
     *           ))
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
