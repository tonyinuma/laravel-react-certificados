<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CertificatesController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Get(
     *     path="/certificates",
     *     summary="return certificates list",
     *     tags={"Certificates"},
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

    /**
     * @OA\Post(
     *     path="/certificates",
     *     summary="Store a Certificate",
     *     tags={"Certificates"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="course_id",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="certificate_date",
     *                     type="date"
     *                 ),
     *                 example={"course_id": "1", "name": "Jhon Doe", "certificate_date": "2021-11-29"}
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *     ),
     *
     *     @OA\Response(
     *         response="400",
     *         description="Failed",
     *     ),
     *
     *     deprecated=false
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), Certificate::rules());

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 400);
        }

        $certificate = Certificate::create($request->all());
        return $this->successResponse($certificate);
    }
}
