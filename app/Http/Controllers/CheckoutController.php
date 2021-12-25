<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // session()->forget('pagseguro_session_code');
        if(!auth()->check()) {
            return redirect()->route('login');
        }
        $this->makePagseguroSession();

        var_dump(session()->get('pagseguro_session_code'));

        return view('checkout');
    }

    private function makePagseguroSession()
    {
        if(!session()->has('pagseguro_session_code')) {

            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
