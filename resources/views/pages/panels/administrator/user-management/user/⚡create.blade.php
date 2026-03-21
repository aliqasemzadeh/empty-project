<?php

use Livewire\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
};
?>

<flux:modal name="panels.administrator.user-management.user.create.modal" class="md:w-96" flyout position="right">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('common.create_user') }}</flux:heading>
            <flux:text class="mt-2">{{ __('common.create_user_description') }}</flux:text>
        </div>
        <!-- Modal body -->
        <form wire:submit="create" method="post" class="space-y-4">
            <flux:field>
                <flux:label>{{ __('common.first_name') }}</flux:label>
                <flux:input wire:model="first_name" type="text" />
                <flux:error name="first_name" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('common.last_name') }}</flux:label>
                <flux:input wire:model="last_name" type="text" />
                <flux:error name="last_name" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('common.mobile') }}</flux:label>
                <flux:input wire:model="mobile" type="text" />
                <flux:error name="mobile" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('common.email') }}</flux:label>
                <flux:input wire:model="email" type="email" />
                <flux:error name="email" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('common.password') }}</flux:label>
                <flux:input wire:model="password" type="password" viewable />
                <flux:error name="password" />
            </flux:field>

            <flux:field>
                <flux:label>{{ __('common.password_confirmation') }}</flux:label>
                <flux:input wire:model="password_confirmation" type="password" viewable />
                <flux:error name="password_confirmation" />
            </flux:field>

            <flux:button type="submit" class="w-full" variant="primary">
                {{ __('common.create') }}
            </flux:button>
        </form>
    </div>
</flux:modal>
