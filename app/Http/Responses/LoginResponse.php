<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        Log::error('login Response' . route(config('fortify.home')));
        Log::error('login Response intended' . redirect()->intended(route(config('fortify.home'))));
        return $request->wantsJson()
                    ? response()->json(['two_factor' => false])
                    : redirect()->intended(route(config('fortify.home')));
    }
}
