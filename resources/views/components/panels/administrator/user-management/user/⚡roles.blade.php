<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Flux\Flux;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

new class extends Component
{
    use WithPagination;

    public User $user;

    public $search;

    #[On('panels.administrator.user-management.user.roles.assign-data')]
    public function assignData($id): void
    {
        $this->user = User::findOrFail($id);
        Flux::modal('panels.administrator.user-management.user.roles.modal')->show();
    }

    public function assign(Role $role)
    {
        $this->authorize('administrator_user_management_roles');

        if (! isset($this->user)) {
            return;
        }
        $this->user->assignRole($role->name);
        $this->dispatch('panels.administrator.user-management.user.roles');
    }

    public function delete(Role $role): void
    {
        $this->authorize('administrator_user_management_roles');

        if (! isset($this->user)) {
            return;
        }
        $this->user->removeRole($role->name);
        $this->dispatch('panels.administrator.user-management.user.roles');
    }

    #[Computed]
    public function roles()
    {
        $this->authorize('administrator_user_management_roles');
        if ($this->search != '') {
            return Role::where('name', 'like', '%'.$this->search.'%')->paginate();
        } else {
            return Role::paginate();
        }
    }
};
?>


<flux:modal name="panels.administrator.user-management.user.roles.modal" class="min-w-full min-h-full">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('common.roles') }}: {{ isset($user) ? $user->mobile : '' }}</flux:heading>
            <flux:text class="mt-2">{{ __('common.roles_description') }}</flux:text>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <flux:field>
                    <flux:field>
                        <flux:label>{{ __('common.search') }}</flux:label>
                        <flux:input wire:model.live="search" type="text" />
                        <flux:error name="search" />
                    </flux:field>
                </flux:field>

                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($this->roles as $role)
                        <li class="pb-3 sm:pb-4">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $role->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">

                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    @can('administrator_user_management_roles')
                                        <flux:button wire:click="assign({{ $role->id }})" wire:confirm="{{ __('common.are_you_sure') }}"><flux:icon.plus-circle /></flux:button>
                                    @endcan
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>


            </div>

            <div>
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach(isset($user) && isset($user->roles) ? $user->roles : [] as $role)
                        <li class="pb-3 sm:pb-4">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $role->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">

                                    </p>
                                </div>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    @can('administrator_user_management_roles')
                                        <flux:button wire:click="delete({{ $role->id }})" wire:confirm="{{ __('common.are_you_sure') }}"><flux:icon.trash /></flux:button>
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
