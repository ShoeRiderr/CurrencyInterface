<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *  @return \Illuminate\View\View
     */
    public function index(): View
    {
        $user = Auth::user() ?? null;
        $userCurrencies = !empty($user) ? $user->currencies->pluck('id') : $user;

        $currencies = Currency::paginate(20);

        return view('index', [
            'currencies' => $currencies,
            'userCurrencies' => $userCurrencies,
        ]);
    }
}
