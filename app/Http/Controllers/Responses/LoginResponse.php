<?php

namespace App\Http\Responses;

use App\Models\User;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return response()->json(['two_factor' => false]);
        }

        $target = $request->user()->hasAnyRole(User::ADMIN_ROLES)
            ? route('admin.dashboard')
            : route('dashboard');

        return redirect()->intended($target);
    }
}