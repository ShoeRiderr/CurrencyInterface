<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use Illuminate\View\View;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *  @return \Illuminate\View\View
     */
    public function index(): View
    {
        $currencies = Currency::paginate(20);

        return view('index', [
            'currencies' => $currencies,
        ]);
    }
}
