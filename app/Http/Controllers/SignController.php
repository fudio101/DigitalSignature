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
        $this->keyService->createKey();
        return view('create-key');
    }
}
