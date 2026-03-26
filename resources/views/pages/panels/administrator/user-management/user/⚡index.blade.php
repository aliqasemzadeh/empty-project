<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    use \Livewire\WithPagination;

    public $sortBy = 'created_at';

    public $sortDirection = 'desc';

    public string $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    public function sort($column)
    {
        if ($this->sortBy === $column) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'asc';
        }
    }

    #[\Livewire\Attributes\Computed]
    public function users()
    {
        return \App\Models\User::query()
            ->when($this->search, function ($query) {
                $search = '%'.$this->search.'%';
                $query->where(function ($q) use ($search) {
                    $q->where('id', 'like', $search)
                        ->orWhere('first_name', 'like', $search)
                        ->orWhere('last_name', 'like', $search)
                        ->orWhere('mobile', 'like', $search)
                        ->orWhere('email', 'like', $search);
                });
            })
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(20);
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
};
?>
<x-slot name="title">
    {{ __('common.users') }}
</x-slot>
<flux:main>
    <div class="relative mb-6 w-full">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl" level="1">{{ __('common.users') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('common.users_description') }}</flux:subheading>
            </div>
            @can('administrator_user_management_create')
                <flux:modal.trigger name="panels.administrator.user-management.user.create.modal">
                    <flux:button variant="primary">{{ __('common.create_user') }}</flux:button>
                </flux:modal.trigger>
            @endcan
        </div>

        <flux:separator variant="subtle" />
    </div>

    <livewire:panels.administrator.user-management.user.create />
    <livewire:panels.administrator.user-management.user.edit />
    <livewire:panels.administrator.user-management.user.permissions />
    <livewire:panels.administrator.user-management.user.roles />

    <flux:card>
        <flux:table :paginate="$this->users">
            <flux:table.columns sticky class="bg-white dark:bg-zinc-900">
                <flux:table.column colspan="5" class="bg-white dark:bg-zinc-900">
                    <div class="flex flex-col gap-1 pe-2 items-end">
                        <flux:input
                            size="sm"
                            placeholder="{{ __('common.search_placeholder') }}"
                            wire:model.live="search"
                        />
                    </div>
                </flux:table.column>
            </flux:table.columns>
            <flux:table.columns>
                <flux:table.column sortable sorted direction="desc">{{ __('common.id') }}</flux:table.column>
                <flux:table.column sortable sorted direction="desc">{{ __('common.email') }}</flux:table.column>
                <flux:table.column sortable sorted direction="desc">{{ __('common.name') }}</flux:table.column>
                <flux:table.column sortable sorted direction="desc">{{ __('common.date') }}</flux:table.column>
                <flux:table.column>{{ __('common.actions') }}</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($this->users as $user)
                    <flux:table.row :key="$user->id">
                        <flux:table.cell>
                            {{ $user->id }}
                        </flux:table.cell>
                        <flux:table.cell class="flex items-center gap-3">
                            {{ $user->email }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $user->name }}
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $user->created_at }}
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down" size="xs">Options</flux:button>
                                <flux:menu>
                                    @can('administrator_user_management_edit')
                                        <flux:menu.item icon="pencil-square" size="xs" wire:click="$dispatch('panels.administrator.user-management.user.edit.assign-data', { id: '{{ $user->id }}' })">{{ __('common.edit') }}</flux:menu.item>
                                    @endcan
                                    @can('administrator_user_management_roles')
                                        <flux:menu.item size="xs" wire:click="$dispatch('panels.administrator.user-management.user.roles.assign-data', { id: '{{ $user->id }}' })">{{ __('common.roles') }}</flux:menu.item>
                                    @endcan
                                    @can('administrator_user_management_permissions')
                                        <flux:menu.item size="xs" wire:click="$dispatch('panels.administrator.user-management.user.permissions.assign-data', { id: '{{ $user->id }}' })">{{ __('common.permissions') }}</flux:menu.item>
                                    @endcan
                                    @can('administrator_user_management_delete')
                                    <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $user->id }})">{{ __('common.delete') }}</flux:menu.item>
                                        @endcan
                                </flux:menu>
                            </flux:dropdown>

                            @can('administrator_user_management_edit')
                                <flux:button size="xs" variant="primary" wire:click="$dispatch('panels.administrator.user-management.user.edit.assign-data', { id: '{{ $user->id }}' })">{{ __('common.edit') }}</flux:button>
                            @endcan
                            @can('administrator_user_management_roles')
                                <flux:button size="xs" variant="primary" color="orange" wire:click="$dispatch('panels.administrator.user-management.user.roles.assign-data', { id: '{{ $user->id }}' })">{{ __('common.roles') }}</flux:button>
                            @endcan
                            @can('administrator_user_management_permissions')
                                <flux:button size="xs" variant="primary" color="lime" wire:click="$dispatch('panels.administrator.user-management.user.permissions.assign-data', { id: '{{ $user->id }}' })">{{ __('common.permissions') }}</flux:button>
                            @endcan
                            @can('administrator_user_management_delete')
                                <flux:button size="xs" variant="danger">{{ __('common.delete') }}</flux:button>
                            @endcan
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </flux:card>
</flux:main>
