<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Media as MediaResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FeedController extends Controller
{
    /**
     * @OA\Get(
     *     path="/feed",
     *     summary="Retrieve authenticated user's media feed",
     *     operationId="readUserFeed",
     *     security={{"bearerAuth": {}}},
     *     tags={},
     *     @OA\Response(
     *        response=200,
     *        description="Successful media retrieval",
     *        @OA\JsonContent(
     *           @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Media")),
     *           @OA\Property(property="links", type="array", @OA\Items(
     *               @OA\Property(property="first", type="string", example="https://foteaux.test/api/v1/feed?page=1"),
     *               @OA\Property(property="last", type="string", example="https://foteaux.test/api/v1/feed?page=3"),
     *               @OA\Property(property="prev", type="string", example="https://foteaux.test/api/v1/feed?page=1"),
     *               @OA\Property(property="next", type="string", example="https://foteaux.test/api/v1/feed?page=3")
     *           )),
     *           @OA\Property(property="meta", type="array", @OA\Items(
     *               @OA\Property(property="current_page", type="number"),
     *               @OA\Property(property="from", type="number", example="16"),
     *               @OA\Property(property="last_page", type="number", example="3"),
     *               @OA\Property(property="path", type="string", example="https://foteaux.test/api/v1/feed?page=2"),
     *               @OA\Property(property="per_page", type="number", example="15"),
     *               @OA\Property(property="to", type="number", example="30"),
     *               @OA\Property(property="total", type="number", example="38")
     *           ))
     *        )
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return MediaResource::collection(auth()->user()?->feed_media->paginate() ?? []);
    }
}
