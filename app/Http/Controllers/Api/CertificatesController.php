<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
    use ApiResponse;
    /**
     * @OA\Get(
     *     path="/certificates",
     *     summary="return certificates list",
     *     tags={"Home"},
     *     @OA\Response(
     *         response=200,
     *         description="Certificates List"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Something went wrong"
     *     ),
     *     deprecated=false
     * )
     */
    public function list()
    {
        $certificates = Certificate::whereNull('deleted_at')->get();
        return $this->successResponse($certificates);
    }

    public function store(Request $request)
    {
        $this->validate($request, Certificate::rules());
        $certificate = Certificate::create($request->all());
        return $this->successResponse($certificate);
    }
}
