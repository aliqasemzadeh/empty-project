<?php

namespace App\Livewire\Forms\Panels\Administrator\UserManagement\User;

use Livewire\Attributes\Validate;
use Livewire\Form;

class UserFrom extends Form
{
    #[Validate('required|min:5')]
    public string $name;
    #[Validate('required|email')]
    public string $email;
    #[Validate('required|min:6')]
    public string $password;

}
