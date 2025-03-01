<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="webstie titlte",
 *     version="1.0.0",
 *     description="API documention",
 *     termsOfService="https://example.com",
 *     contact={
 *         "name"="mahdi",  
 *         "email"="mahdishoorabi@gmail.com",
 *         "url"="https://example.com"
 *     },
 *     license={
 *         "name"="License Name",
 *         "url"="https://example.com"
*     }
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
