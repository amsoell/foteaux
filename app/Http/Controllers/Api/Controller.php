<?php
/**
 * @OA\Server(url="/api/v1")
 *
 * @OA\Info(
 *    title="Foteaux API",
 *    version="1.0.0",
 * )
 *
 * @OA\SecurityScheme(
 *   securityScheme="BasicAuth",
 *   type="http",
 *   scheme="basic"
 * )
 **/

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
}
