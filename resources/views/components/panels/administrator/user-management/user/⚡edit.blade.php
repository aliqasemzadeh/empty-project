<?php

use Livewire\Component;
use App\Livewire\Forms\Panels\Administrator\UserManagement\User\UserForm;
use Livewire\Attributes\On;

new class extends Component
{
    public UserForm $userForm;

    #[On('panels.administrator.user-management.user.edit.assign-data')]
    public function assignData($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $this->userForm->setUser($user);
        \Flux\Flux::modal('panels.administrator.user-management.user.edit.modal')->show();
    }

    public function update()
    {
        $this->userForm->update();
        \Flux\Flux::toast('common.user_edited');
    }
};
?>

<flux:modal name="panels.administrator.user-management.user.edit.modal" class="md:w-96" flyout position="right">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('common.edit_user') }}: {{ $userForm->name ?? "" }}</flux:heading>
            <flux:text class="mt-2">{{ __('common.edit_user_description') }}</flux:text>
        </div>
        <!-- Modal body -->
        <form wire:submit="update" method="post" class="space-y-4">
            <flux:field>
                <flux:label>{{ __('common.name') }}</flux:label>
                <flux:input wire:model="userForm.name" type="text" />
                <flux:error name="userForm.name" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('common.email') }}</flux:label>
                <flux:input wire:model="userForm.email" type="email" />
                <flux:error name="userForm.email" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('common.password') }}</flux:label>
                <flux:input wire:model="userForm.password" type="password" viewable />
                <flux:error name="userForm.password" />
            </flux:field>

            <flux:button type="submit" class="w-full" variant="primary">
                {{ __('common.update') }}
            </flux:button>
        </form>
    </div>
</flux:modal>
