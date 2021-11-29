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
     * @OA\Get(
     *     path="/certificates/{id}",
     *     summary="return certificates by id",
     *     tags={"Certificates"},
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="Certificate ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="Certificate By Id"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Something went wrong"
     *     ),
     *     deprecated=false
     * )
     */
    public function find($id)
    {
        $certificate = Certificate::find($id);
        return $this->successResponse($certificate);
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

    /**
     * @OA\Put(
     *     path="/certificates/{id}",
     *     summary="Modifiy Certificates",
     *     tags={"Certificates"},
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="Certificate ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="course_id",
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
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), Certificate::rules(true));

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->first(), 400);
            }

            $certificate = Certificate::find($id);
            $certificate->course_id = $request->get('course_id');
            $certificate->name = $request->get('name');
            $certificate->certificate_date = $request->get('certificate_date');
            $certificate->update();

        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 400);
        }

        return $this->successResponse([
            'status' => 200,
            'message' => 'Updated Successfully'
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/certificates/{id}",
     *     summary="Delete a Certificate",
     *     tags={"Certificates"},
     *
     *     @OA\Parameter(
     *          name="id",
     *          description="Certificate ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *
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
    public function delete($id)
    {
        try {

            $certificate = Certificate::destroy($id);

        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 400);
        }

        return $this->successResponse("Certificate deleted");
    }
}
