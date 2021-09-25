<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Http\Resources\CurrencyResource;
use Illuminate\Contracts\Support\Responsable;

class BankController extends Controller
{
    public function index(): Responsable
    {
        $currencies = Currency::all();

        return CurrencyResource::collection($currencies);
    }
}
