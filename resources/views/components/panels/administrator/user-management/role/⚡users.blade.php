<?php

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

new class extends Component
{
    public Role $role;

    #[\Livewire\Attributes\On('panels.administrator.user-management.role.users.assign-data')]
    public function assignData($id)
    {
        $this->role = Role::with(['users'])->findOrFail($id);
        \Flux\Flux::modal('panels.administrator.user-management.role.users.modal')->show();
    }

    public function revoke($id, $name)
    {
        $this->authorize('administrator_user_management_role_users');
        $selected_user = User::findOrFail($id);
        $selected_user->removeRole($name);
    }
};
?>

<flux:modal name="panels.administrator.user-management.role.users.modal"  class="min-w-full min-h-full">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('common.users') }}: {{ $role->name ?? "" }}</flux:heading>
            <flux:text class="mt-2">{{ __('common.role_users_description') }}</flux:text>
        </div>
        <div>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($role->users ?? [] as $user)
                    <li class="pb-3 sm:pb-4">
                        <div class="flex items-center space-x-4 rtl:space-x-reverse">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ $user->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">

                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                @can('administrator_user_management_role_users')
                                    <flux:button size="xs" wire:confirm="{{ __('common.are_you_sure') }}" wire:click="revoke('{{ $user->id  }}', '{{ $role->name }}')" icon="trash" />
                                @endcan
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</flux:modal>
