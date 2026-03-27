<?php

use Flux\Flux;
use Livewire\Component;
use Spatie\Permission\Models\Role;

new class extends Component
{
    public string $name = '';
    public string $guard_name = 'web';

    public function create()
    {
        $this->authorize('administrator_user_management_role_create');

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:' . Role::class],
            'guard_name' => ['required', 'string', 'max:255', 'in:web'],
        ]);

        Role::create($validated);

        Flux::modal('panels.administrator.user-management.role.create.modal')->close();
    }
};
?>

<flux:modal name="panels.administrator.user-management.role.create.modal" flyout position="right" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('common.create_role') }}</flux:heading>
            <flux:text class="mt-2">{{ __('common.create_role_description') }}</flux:text>
        </div>
        <form wire:submit="create" method="post">
            <div class="pb-2">
                <flux:field>
                    <flux:label>{{ __('common.name') }}</flux:label>

                    <flux:input wire:model="name" type="text" />

                    <flux:error name="name" />
                </flux:field>
                <flux:field>
                    <flux:label>{{ __('common.guard_name') }}</flux:label>

                    <flux:input wire:model="guard_name" type="text" />

                    <flux:error name="guard_name" />
                </flux:field>
            </div>
            <button type="submit" class="btn-default btn-indigo w-full">
                {{ __('common.create') }}
            </button>
        </form>
    </div>
</flux:modal>
