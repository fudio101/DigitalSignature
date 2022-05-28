<?php

namespace App\Http\Controllers;

use App\Services\ECDSAService;
use App\Services\RSASignatureService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;

class SignController extends Controller
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

    /**
     * @return Factory|View|Application
     */
    final public function index(): Factory|View|Application
    {
        return view('sign');
    }

    /**
     * @return JsonResponse
     */
    final public function genKeyECDSA(): JsonResponse
    {
        return response()->json([
            'key' => $this->ECDSAService->genKey()
        ]);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    final public function signECDSA(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'msg' => 'required',
            'hexKey' => 'required',
        ]);

        if ($validate) {
            $msg = $request->input('msg');
            $hexKey = $request->input('hexKey');
            $key = $this->ECDSAService->getKey($hexKey);
            $signature = $this->ECDSAService->sign($key, $msg);
            return response()->json([
                'error' => false,
                'signature' => $signature,
                'publicKey' => $this->ECDSAService->getPublicKey($key),
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }

    final public function genKeyRSASignature()
    {
        $key = $this->RSASignatureService->genKey();
        return response()->json([
            'key' => $key,
        ]);
    }
}
