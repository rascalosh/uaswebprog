<?php

namespace Filament\Http\Controllers\Auth;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse;
use Illuminate\Http\RedirectResponse;

class LogoutController
{
    public function __invoke(): RedirectResponse
    {
        Filament::auth()->logout();

        session()->invalidate();
        session()->regenerateToken();

        // return app(LogoutResponse::class);
        return redirect('/login');
    }

    
}
