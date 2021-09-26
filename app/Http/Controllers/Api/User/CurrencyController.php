<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * @param   Request  $request
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();

        if (empty($user)){
            return new JsonResponse('Użytkownik jest nie zalogowany', 401);
        }

        return new JsonResponse($user->currencies()->paginate(20), 200);
    }
}
