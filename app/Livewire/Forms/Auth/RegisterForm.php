<?php

namespace App\Livewire\Forms\Auth;

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
            'name' => ['required', 'email', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,name'],
            'password' => ['required', 'password'],
        ];
    }

    public function register()
    {

    }
}
