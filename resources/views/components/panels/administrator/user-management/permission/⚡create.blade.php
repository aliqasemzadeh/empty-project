<?php

use Flux\Flux;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

new class extends Component
{
    public string $name = '';
    public string $guard_name = 'web';

    public function create()
    {
        $this->authorize('administrator_user_management_permission_create');

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255', 'unique:' . Permission::class],
            'guard_name' => ['required', 'string', 'max:255', 'in:web'],
        ]);

        Permission::create($validated);

        $this->dispatch('pg:eventRefresh-administrator.user-management.permission.index');
        Flux::modal('panels.administrator.user-management.permission.create.modal')->close();

    }
};
?>

<flux:modal name="panels.administrator.user-management.permission.create.modal" flyout position="right" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('common.create_permission') }}</flux:heading>
            <flux:text class="mt-2">{{ __('common.create_permission_description') }}</flux:text>
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
            <flux:button type="submit" class="w-full" variant="primary">
                {{ __('common.create') }}
            </flux:button>
        </form>
    </div>
</flux:modal>
