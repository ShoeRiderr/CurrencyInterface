<?php

namespace App\Http\Controllers\Api\User\Currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Enums\ActionType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\ActionRequest;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CurrencyResource;

class ActionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\User\ActionRequest  $request
     * @return  \Illuminate\Contracts\Support\Responsable|\Illuminate\Http\JsonResponse
     */
    public function __invoke(ActionRequest $request)
    {
        $user = Auth::user();

        if (empty($user)){
            return new JsonResponse('Użytkownik jest nie zalogowany', 401);
        }

        switch ($request->input('state')) {
            case ActionType::ADD_FAVOURITES:
                $userCurrencies = $user->currencies->pluck('id')->toArray();

                $currencyIds = collect($request->input('currencies'))->filter(function ($currency) use ($userCurrencies) {
                    return !in_array($currency, $userCurrencies);
                });

                $user->currencies()->attach($currencyIds);

                return CurrencyResource::collection($user->currencies);
            case ActionType::REMOVE_FAVOURITES:
                $user->currencies()->detach($request->input('currencies'));

                return CurrencyResource::collection($user->currencies);
            default:
                return new JsonResponse('Użytkownik jest nie zalogowany', 401);
        }
    }
}