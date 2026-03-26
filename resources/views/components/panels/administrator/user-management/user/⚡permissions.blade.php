<?php

use Livewire\Component;
use App\Models\User;
use Flux\Flux;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

new class extends Component
{
    use WithPagination;

    public User $user;

    public $search;

    #[On('panels.administrator.user-management.user.permissions.assign-data')]
    public function assignData($id): void
    {
        $this->user = User::findOrFail($id);
        Flux::modal('panels.administrator.user-management.user.permissions.modal')->show();
    }

    public function assign(Permission $permission)
    {
        $this->authorize('administrator_user_management_permissions');

        if (! isset($this->user)) {
            return;
        }
        $this->user->givePermissionTo($permission->name);
        $this->dispatch('panels.administrator.user-management.user.permissions');
    }

    public function delete(Permission $permission): void
    {
        $this->authorize('administrator_user_management_permissions');

        if (! isset($this->user)) {
            return;
        }
        $this->user->revokePermissionTo($permission->name);
        $this->dispatch('panels.administrator.user-management.user.permissions');
    }

    #[\Livewire\Attributes\Computed]
    public function permissions()
    {
        if ($this->search != '') {
            return Permission::where('name', 'like', '%'.$this->search.'%')->paginate();
        } else {
            return Permission::paginate();
        }
    }
};
?>

<flux:modal name="panels.administrator.user-management.user.permissions.modal" class="min-w-full min-h-full">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('common.permissions') }}: {{ isset($user) ? $user->email : '' }}</flux:heading>
            <flux:text class="mt-2">{{ __('common.permissions_description') }}</flux:text>
        </div>


        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:field>
                        <flux:label>{{ __('common.search') }}</flux:label>
                        <flux:input wire:model.live="search" type="text" size="sm" />
                        <flux:error name="search" />
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
                                    @can('administrator_user_management_permissions')
                                        <flux:button size="xs" wire:click="assign({{ $permission->id }})" icon="plus-circle" wire:confirm="{{ __('common.are_you_sure') }}" />
                                    @endcan
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>


            </div>

            <div>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach(isset($user) && isset($user->permissions) ? $user->permissions : [] as $permission)
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
                                    @can('administrator_user_management_permissions')
                                        <flux:button size="xs" wire:click="delete({{ $permission->id }})" icon="trash" wire:confirm="{{ __('common.are_you_sure') }}" />
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
