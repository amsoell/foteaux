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
     *           @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Media"))
     *        )
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return MediaResource::collection(auth()->user()?->feed_media->paginate() ?? []);
    }
}
