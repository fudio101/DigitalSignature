<?php

namespace App\Http\Controllers;

use App\Services\ECDSAService;
use App\Services\RSASignatureService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
     * @return RedirectResponse
     */
    final public function index(): RedirectResponse
    {
        return redirect()->route('ECDSAShow');
    }

    /**
     * @return Factory|View|Application
     */
    final public function showECDSA(): Factory|View|Application
    {
        return view('ECDSASign', ['page' => 'ECDSASign']);
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
            'message' => 'required',
            'privateKey' => 'required',
        ]);

        if ($validate) {
            $msg = $request->input('message');
            $hexKey = $request->input('privateKey');
            $key = $this->ECDSAService->getPKey($hexKey);
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

    /**
     * @return Factory|View|Application
     */
    final public function showRSA(): Factory|View|Application
    {
        return view('RSASign', ['page' => 'RSASign']);
    }

    /**
     * @return JsonResponse
     */
    final public function genKeyRSASignature(): JsonResponse
    {
        $key = $this->RSASignatureService->genKey();
        return response()->json([
            'key' => $key,
        ]);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    final public function signRSA(Request $request): JsonResponse
    {
        $validate = $request->validate([
            'message' => 'required',
            'privateKey' => 'required',
        ]);

        if ($validate) {
            $msg = $request->input('message');
            $textKey = $request->input('privateKey');
            $uKey = $this->RSASignatureService->getPublicKey($textKey);
            $pKey = $this->RSASignatureService->getPKey($textKey);
            if ($pKey) {
                $result = $this->RSASignatureService->sign($pKey, $msg);
                return response()->json([
                    'error' => false,
                    'hashValue' => $result[0],
                    'signature' => $result[1],
                    'publicKey' => $uKey,
                ]);
            }
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
