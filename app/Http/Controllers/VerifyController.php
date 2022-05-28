<?php

namespace App\Http\Controllers;

use App\Services\ECDSAService;
use App\Services\KeyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    /**
     * @var KeyService
     * @var ECDSAService
     * Import Algorithm Service
     */
    protected KeyService $keyService;
    protected ECDSAService $ECDSAService;

    public function __construct(KeyService $keyService, ECDSAService $ECDSAService)
    {
        $this->keyService = $keyService;
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
