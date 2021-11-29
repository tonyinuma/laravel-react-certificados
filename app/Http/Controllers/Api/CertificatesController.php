<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Certificate;

class CertificatesController extends Controller
{
    public function list()
    {
        $certificates = Certificate::whereNull('deleted_at')->get();
        return response()->json($certificates);
    }
}
