<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CurrencyController extends Controller
{
    /**
     * @return  \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $user = Auth::user();

        if (empty($user)){
            return redirect()->to('/');
        }

        return view('user.index', [
            'currencies' => $user->currencies()->paginate(20)
        ]);
    }
}
