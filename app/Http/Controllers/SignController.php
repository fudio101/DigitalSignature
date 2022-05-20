<?php

namespace App\Http\Controllers;

use App\Services\ECDSAService;
use App\Services\KeyService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;

class SignController extends Controller
{
    /**
     * @var KeyService
     * @var ECDSAService
     * Import Algorithm Service
     */
    protected $keyService;
    protected $ECDSAService;

    public function __construct(KeyService $keyService, ECDSAService $ECDSAService)
    {
        $this->keyService = $keyService;
        $this->ECDSAService = $ECDSAService;
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view('sign');
    }

    /**
     * @return Factory|View|Application
     */
    public function keyIndex(): Factory|View|Application
    {
        $dn = array(
            "countryName" => "VN",
            "stateOrProvinceName" => "HCM",
            "localityName" => "Thu Duc",
            "organizationName" => "Fudio",
            "organizationalUnitName" => "Fudio",
            "commonName" => "fudio101",
            "emailAddress" => "thenguyen1024@gmail.com"
        );
        $this->keyService->createCertificate($dn, 365, 'Ng01637202484', public_path(), '1');
        return view('create-key');
    }

    public function test($msg): void
    {
        $this->ECDSAService->test($msg);
    }
}
