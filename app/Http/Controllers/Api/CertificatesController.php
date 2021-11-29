<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;

class CertificatesController extends Controller
{
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
        return response()->json($certificates);
    }

    public function store(Request $request)
    {
        $this->validate($request, Certificate::rules());
        $certificate = Certificate::create($request->all());
        return response()->json($certificate);
    }
}
