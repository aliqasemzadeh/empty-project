<?php

use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

new class extends Component
{
    use WithPagination;

    public Role $role;

    public $search;

    public function mount($id = 1)
    {
        $this->role = Role::findById($id);
    }

    #[On('panels.administrator.user-management.role.permissions.assign-data')]
    public function assignData(int $id): void
    {
        $this->role = Role::findById($id);
        Flux::modal('panels.administrator.user-management.role.permissions.modal')->show();
    }

    public function assign(Permission $permission)
    {
        $this->authorize('administrator_user_management_role_permissions');

        $this->role->givePermissionTo($permission->name);
        $this->dispatch('panels.administrator.user-management.role.permissions');
    }

    public function delete(Permission $permission): void
    {
        $this->authorize('administrator_user_management_role_permissions');

        $this->role->revokePermissionTo($permission->name);
        $this->dispatch('panels.administrator.user-management.role.permissions');
    }

    #[\Livewire\Attributes\Computed]
    public function render()
    {
        $this->authorize('administrator_user_management_role_permissions');
        if ($this->search != '') {
            $permissions = Permission::where('name', 'like', '%'.$this->search.'%')->paginate();
        } else {
            $permissions = Permission::paginate();
        }

        return $permissions;
    }
};
?>

<flux:modal name="panels.administrator.user-management.role.permissions.modal" class="min-w-full min-h-full">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('common.permissions') }}: {{ $role->name }}</flux:heading>
            <flux:text class="mt-2">{{ __('common.role_permissions_description') }}</flux:text>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:field>
                    <flux:field>
                        <flux:label>{{ __('app.search') }}</flux:label>
                        <flux:input wire:model.live="search" type="text" />
                        <flux:error name="search" />
                    </flux:field>
                </flux:field>

                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($this->permissions as $permission)
                        <li class="pb-3 sm:pb-4">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $permission->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">

                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    @can('administrator_user_management_role_permissions')
                                        <flux:button wire:click="assign({{ $permission->id }})" wire:confirm="{{ __('app.are_you_sure') }}"><flux:icon.plus-circle /></flux:button>
                                    @endcan
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>


            </div>

            <div>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($role->permissions as $permission)
                        <li class="pb-3 sm:pb-4">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $permission->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">

                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    @can('administrator_user_management_role_permissions')
                                        <flux:button wire:click="delete({{ $permission->id }})" wire:confirm="{{ __('app.are_you_sure') }}"><flux:icon.trash /></flux:button>
                                    @endcan
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
</flux:modal>
