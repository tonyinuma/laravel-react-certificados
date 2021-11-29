<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *     title="TestUsil2021",
     *     version="1.0.0"
     * )
     *
     * @OA\SecurityScheme(
     *     type="http",
     *     description="login",
     *     name="token",
     *     in="header",
     *     scheme="bearer",
     *     bearerFormat="JWT",
     *     securityScheme="apiAuth"
     * )
     *
     * @OA\Server(
     *      url="http://testusil2021.tk/api",
     *      description="Test Usil",
     *
     * @OA\ServerVariable(
     *      serverVariable="schema",
     *      enum={"https", "http"},
     *      default="http"
     *  )
     * )
     *
     * @OA\Server(
     *      url="http://comicomerce.com/api",
     *      description="comicomerce.com",
     *
     * @OA\ServerVariable(
     *      serverVariable="schema",
     *      enum={"http"},
     *      default="http"
     *  )
     * )
     * @OA\Server(
     *      url="http://127.0.0.1/api",
     *      description="localhost",
     *
     * @OA\ServerVariable(
     *      serverVariable="schema",
     *      enum={"http"},
     *      default="http"
     *  )
     * )
     *
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
