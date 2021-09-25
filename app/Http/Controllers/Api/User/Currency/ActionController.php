<?php

namespace App\Http\Controllers\Api\User\Currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Enums\ActionType;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\ActionRequest;

class ActionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \App\Http\Requests\User\ActionRequest  $request
     */
    public function __invoke(ActionRequest $request): RedirectResponse
    {
        $user = Auth::user();

        if (empty($user)){
            return redirect()->to('/');
        }

        switch ($request->input('state')) {
            case ActionType::ADD_FAVOURITES:
                $userCurrencies = $user->currencies->pluck('id')->toArray();

                $currencyIds = collect($request->input('currencies'))->filter(function ($currency) use ($userCurrencies) {
                    return !in_array($currency, $userCurrencies);
                });

                $user->currencies()->attach($currencyIds);

                return redirect()->to('/')->with('message', 'Pomyślnie dodano waluty do ulubionej listy');
            case ActionType::REMOVE_FAVOURITES:
                $user->currencies()->detach($request->input('currencies'));

                return redirect()->to(route('currency.index'))->with('message', 'Pomyślnie usunięto waluty z ulubionej listy');
        }

        return redirect()->to('/');
    }
}