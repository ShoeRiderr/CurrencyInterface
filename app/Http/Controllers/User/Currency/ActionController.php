<?php

namespace App\Http\Controllers\User\Currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Enums\ActionType;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $user = Auth::user();
        // dd($user->currencies);
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
