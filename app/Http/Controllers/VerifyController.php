<?php

namespace App\Http\Controllers;

use App\Services\ECDSAService;
use App\Services\RSASignatureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    /**
     * @var RSASignatureService
     * @var ECDSAService
     * Import Algorithm Service
     */
    protected RSASignatureService $RSASignatureService;
    protected ECDSAService $ECDSAService;

    public function __construct(RSASignatureService $RSASignatureService, ECDSAService $ECDSAService)
    {
        $this->RSASignatureService = $RSASignatureService;
        $this->ECDSAService = $ECDSAService;
    }

    public function index()
    {
        return view('verify');
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    final public function verifyECDSA(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'msg' => 'required',
            'hexKey' => 'required',
            'signature' => 'required',
        ]);

        if ($validate) {
            $msg = $request->input('msg');
            $hexKey = $request->input('hexKey');
            $signature = $request->input('signature');
            $key = $this->ECDSAService->getKey($hexKey);
            $result = $this->ECDSAService->verify($key, $msg, $signature);
            return response()->json([
                'error' => false,
                'result' => $result,
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
