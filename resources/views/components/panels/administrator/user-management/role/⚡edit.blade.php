<?php

use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

new class extends Component
{
    public Role $role;

    public string $name = '';

    public string $guard_name = 'web';

    #[On('panels.administrator.user-management.role.edit.assign-data')]
    public function assignData(int $id): void
    {
        $this->role = Role::findById($id);
        $this->name = $this->role->name;
        $this->guard_name = $this->role->guard_name;
        Flux::modal('panels.administrator.user-management.role.edit.modal')->show();
    }

    public function edit()
    {
        $this->authorize('administrator_user_management_role_edit');

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($this->role->id)],
            'guard_name' => ['required', 'string', 'max:255', 'in:web'],
        ]);

        $this->role->update($validated);

        Flux::modal('panels.administrator.user-management.role.edit.modal')->close();

    }
};
?>

<flux:modal name="panels.administrator.user-management.role.edit.modal" flyout position="right" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('common.edit_role') }} : {{ $role->name ?? "" }}</flux:heading>
            <flux:text class="mt-2">{{ __('common.edit_role_description') }}</flux:text>
        </div>
        <!-- Modal body -->
        <form wire:submit="edit" method="post">
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
                {{ __('common.update') }}
            </flux:button>
        </form>
    </div>
</flux:modal>
