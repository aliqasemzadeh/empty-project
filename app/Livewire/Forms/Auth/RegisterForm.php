<?php

namespace App\Livewire\Forms\Auth;

use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class RegisterForm extends Form
{
    #[Validate]
    public string $name = '';
    public string $email = '';
    public string $password = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
        ];
    }

    public function register()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);


        if (! Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password], true)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        Flux::toast(__('common.register_successfully_done'));
    }
}
