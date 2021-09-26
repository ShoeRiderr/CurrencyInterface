<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;

class BankController extends Controller
{
    public function index(): JsonResponse
    {
        $currencies = Currency::all();

        return new JsonResponse(Currency::paginate(20), 200);
    }
}
