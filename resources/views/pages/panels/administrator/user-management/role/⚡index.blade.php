<?php

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    use WithPagination;

    public string $sortBy = 'created_at';

    public string $sortDirection = 'desc';

    public function sort(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[\Livewire\Attributes\Computed]
    public function roles()
    {
        return Role::query()
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(10);
    }
};
?>


<x-slot name="title">
    {{ __('common.roles') }}
</x-slot>

<flux:main>
    <div class="relative mb-6 w-full">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl" level="1">{{ __('common.roles') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('common.roles_description') }}</flux:subheading>
            </div>
            @can('administrator_user_management_role_create')
                <flux:modal.trigger name="panels.administrator.user-management.role.create.modal">
                    <flux:button variant="primary">{{ __('common.create_role') }}</flux:button>
                </flux:modal.trigger>
            @endcan
        </div>

        <flux:separator variant="subtle" />
    </div>

    <livewire:panels.administrator.user-management.role.create />
    <livewire:panels.administrator.user-management.role.edit />
    <livewire:panels.administrator.user-management.role.permissions />
    <livewire:panels.administrator.user-management.role.users />
    <flux:card>
        <flux:table>
            <flux:table.columns>
                <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection" wire:click="sort('name')">{{ __('common.name') }}</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'guard_name'" :direction="$sortDirection" wire:click="sort('guard_name')">{{ __('common.guard_name') }}</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection" wire:click="sort('created_at')">{{ __('common.date') }}</flux:table.column>
                <flux:table.column />
            </flux:table.columns>

            @foreach ($this->roles as $role)
                <flux:table.row :key="$role->id">
                    <flux:table.cell class="whitespace-nowrap">{{ $role->name }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $role->guard_name }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $role->created_at?->format('Y-m-d H:i') }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">


                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down" size="xs">{{ __('common.options') }}</flux:button>
                                <flux:menu>
                                    @can('administrator_user_management_edit')
                                        <flux:menu.item icon="pencil-square" size="xs" wire:click="$dispatch('panels.administrator.user-management.role.edit.assign-data', { id: '{{ $role->id }}' })">{{ __('common.edit') }}</flux:menu.item>
                                    @endcan
                                    @can('administrator_user_management_roles')
                                        <flux:menu.item icon="users" size="xs" wire:click="$dispatch('panels.administrator.user-management.role.users.assign-data', { id: '{{ $role->id }}' })">{{ __('common.users') }}</flux:menu.item>
                                    @endcan
                                    @can('administrator_user_management_permissions')
                                        <flux:menu.item icon="scan-eye" size="xs" wire:click="$dispatch('panels.administrator.user-management.role.permissions.assign-data', { id: '{{ $role->id }}' })">{{ __('common.permissions') }}</flux:menu.item>
                                    @endcan
                                    @can('administrator_user_management_delete')
                                        <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $role->id }})" wire:confirm="{{ __('common.are_you_sure') }}">{{ __('common.delete') }}</flux:menu.item>
                                    @endcan
                                </flux:menu>
                            </flux:dropdown>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table>
    </flux:card>
</flux:m>
