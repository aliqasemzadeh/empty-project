<?php

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    use WithPagination;

    public string $sortBy = 'created_at';
    public string $sortDirection = 'desc';
    public string $search = '';
    public int $page = 1;

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

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
    public function permissions()
    {
        return Permission::query()
            ->when($this->search, function ($query) {
                $search = '%' . $this->search . '%';
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', $search)
                        ->orWhere('guard_name', 'like', $search);
                });
            })
            ->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(config('common.per_page'));
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }
};
?>

<x-slot name="title">
    {{ __('common.permissions') }}
</x-slot>


<flux:main>
    <div class="relative mb-6 w-full">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl" level="1">{{ __('common.permissions') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('common.permissions_description') }}</flux:subheading>
            </div>
            @can('administrator_user_management_permission_create')
                <flux:modal.trigger name="panels.administrator.user-management.permission.create.modal">
                    <flux:button variant="primary">{{ __('common.create_permission') }}</flux:button>
                </flux:modal.trigger>
            @endcan
        </div>

        <flux:separator variant="subtle" />
    </div>

    <livewire:panels.administrator.user-management.permission.create />
    <livewire:panels.administrator.user-management.permission.edit />
    <flux:card>
        <flux:table :paginate="$this->permissions">
            <flux:table.columns sticky class="bg-white dark:bg-zinc-900">
                <flux:table.column colspan="4" class="bg-white dark:bg-zinc-900">
                    <div class="flex flex-col gap-1 ps-2 items-start">
                        <flux:input
                            icon="magnifying-glass"
                            size="sm"
                            placeholder="{{ __('common.search_placeholder') }}"
                            wire:model.live="search"
                        />
                    </div>
                </flux:table.column>
            </flux:table.columns>
            <flux:table.columns>
                <flux:table.column sortable :sorted="$sortBy === 'name'" :direction="$sortDirection" wire:click="sort('name')">{{ __('common.name') }}</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'guard_name'" :direction="$sortDirection" wire:click="sort('guard_name')">{{ __('common.guard_name') }}</flux:table.column>
                <flux:table.column sortable :sorted="$sortBy === 'created_at'" :direction="$sortDirection" wire:click="sort('created_at')">{{ __('common.date') }}</flux:table.column>
                <flux:table.column />
            </flux:table.columns>

            @foreach ($this->permissions as $permission)
                <flux:table.row :key="$permission->id">
                    <flux:table.cell class="whitespace-nowrap">{{ $permission->name }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $permission->guard_name }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">{{ $permission->created_at?->format('Y-m-d H:i') }}</flux:table.cell>
                    <flux:table.cell class="whitespace-nowrap">
                        <flux:dropdown>
                            <flux:button icon:trailing="chevron-down" size="xs">{{ __('common.options') }}</flux:button>
                            <flux:menu>
                                @can('administrator_user_management_permission_edit')
                                    <flux:menu.item icon="pencil-square" size="xs" wire:click="$dispatch('panels.administrator.user-management.permission.edit.assign-data', { id: '{{ $permission->id }}' })">{{ __('common.edit') }}</flux:menu.item>
                                @endcan
                                @can('administrator_user_management_permission_delete')
                                    <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $permission->id }})" wire:confirm="{{ __('common.are_you_sure') }}">{{ __('common.delete') }}</flux:menu.item>
                                @endcan
                            </flux:menu>
                        </flux:dropdown>
                    </flux:table.cell>
                </flux:table.row>
            @endforeach
        </flux:table>
    </flux:card>
</flux:main>
