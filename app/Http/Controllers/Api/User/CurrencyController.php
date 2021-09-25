<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CurrencyResource;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * @param   Request  $request
     * @return  \Illuminate\Contracts\Support\Responsable|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if (empty($user)){
            return new JsonResponse('Użytkownik jest nie zalogowany', 401);
        }

        return CurrencyResource::collection($$user->currencies);
    }
}
