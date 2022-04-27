<?php

namespace App\Http\Controllers;

use App\Services\KeyService;
use Illuminate\Http\Request;

class SignController extends Controller
{

    protected $keyService;

    public function __construct(KeyService $keyService)
    {
        $this->keyService = $keyService;
    }

    public function index()
    {
        return view('sign');
    }

    public function keyIndex()
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
}
