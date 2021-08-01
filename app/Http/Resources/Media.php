<?php
/**
 * @OA\Schema(
 *   schema="Media",
 *   type="object",
 *   description="Media item",
 *   allOf={
 *       @OA\Schema(
 *           @OA\Property(property="id", type="number"),
 *           @OA\Property(property="url", type="string"),
 *           @OA\Property(property="user", ref="#/components/schemas/User")
 *       )
 *   }
 * )
 **/

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Media extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'   => $this->id,
            'url'  => $this->url,
            'user' => new User($this->user),
        ];
    }
}
