<?php

namespace App\Http\Controllers;

use App\Services\ECDSAService;
use App\Services\RSASignatureService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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

    /**
     * @return Factory|View|Application
     */
    final public function showECDSA(): Factory|View|Application
    {
        return view('ECDSAVerify', ['page' => 'ECDSAVerify']);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    final public function verifyECDSA(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'message' => 'required',
            'publicKey' => 'required',
            'signature' => 'required',
        ]);

        if ($validate) {
            $msg = $request->input('message');
            $hexKey = $request->input('publicKey');
            $signature = $request->input('signature');
            $result = $this->ECDSAService->verifyText($hexKey, $msg, $signature);
            return response()->json([
                'error' => false,
                'result' => $result,
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }

    /**
     * @return Factory|View|Application
     */
    final public function showRSA(): Factory|View|Application
    {
        return view('RSAVerify', ['page' => 'RSAVerify']);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    final public function verifyRSA(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'message' => 'required',
            'publicKey' => 'required',
            'signature' => 'required',
        ]);

        if ($validate) {
            $msg = $request->input('message');
            $textKey = $request->input('publicKey');
            $signature = $request->input('signature');
            $result = $this->RSASignatureService->verifyText($textKey, $msg, $signature);
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
