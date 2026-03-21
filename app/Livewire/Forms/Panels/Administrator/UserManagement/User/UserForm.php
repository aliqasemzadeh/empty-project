<?php

namespace App\Livewire\Forms\Panels\Administrator\UserManagement\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Hash;

class UserForm extends Form
{
    public ?User $user;
    #[Validate]
    public string $name;
    #[Validate]
    public string $email;
    #[Validate]
    public string $password;

    public function rules(): array
    {
        if(isset($this->user)) {
            return [
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
                'password' => ['required', 'string', 'min:8'],
            ];
        }
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8'],
        ];

    }

    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->name = $user->title;

        $this->email = $user->email;
    }

    public function store()
    {
        $this->validate();

        $userPack = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];

        User::create($userPack);
    }

    public function update()
    {
        $this->validate();

        $userPack = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ];

       $this->user->update($userPack);
    }

}
