<?php

namespace App\Livewire\Forms\Auth;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class LogoutForm extends Form
{
    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        Flux::toast(
            text: __('common.logout_success'),
            variant: 'success',
        );
    }
}
