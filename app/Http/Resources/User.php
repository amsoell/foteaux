<?php
/**
 * @OA\Schema(
 *   schema="User",
 *   type="object",
 *   description="User details",
 *   allOf={
 *       @OA\Schema(
 *           @OA\Property(property="id", type="number"),
 *           @OA\Property(property="name", type="string"),
 *           @OA\Property(property="username", type="string")
 *       )
 *   }
 * )
 **/

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'id'       => $this->id,
            'name'     => $this->name,
            'username' => $this->username,
        ];
    }
}
