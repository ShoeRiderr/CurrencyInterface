<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use App\Enums\ActionType;

class CurrencyController extends Controller
{
    public function index(): View
    {
        return view('user.index', [
            'currencies' => Auth::user()->currencies()->paginate(20)
        ]);
    }

    public function action(Request $request): RedirectResponse
    {
        switch ($request->input('state')) {
            case ActionType::ADD_FAVOURITES:
                Auth::user()->currencies()->attach($request->input('currencies'));

                return redirect()->to(route('currency.index'))->withFlash('Pomyślnie dodano waluty do ulubionej listy');
            case ActionType::REMOVE_FAVOURITES:
                Auth::user()->currencies()->detach($request->input('currencies'));

                return redirect()->to(route('currency.index'))->with('message', 'Pomyślnie usunięto waluty z ulubionej listy');
        }

        return redirect()->to('/'); 
    }
}
