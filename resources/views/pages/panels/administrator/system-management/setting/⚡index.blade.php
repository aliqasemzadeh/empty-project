<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    use \Livewire\WithPagination;

    public string $search =  '';

    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    #[\Livewire\Attributes\Computed]
    public function settings()
    {
        return \App\Models\System\Setting::query()
            ->when($this->search, function ($query) {
                $search = '%'.$this->search.'%';
                $query->where(function ($q) use ($search) {
                    $q->where('translate', 'like', $search)
                        ->orWhere('name', 'like', $search)
                        ->orWhere('group', 'like', $search)
                        ->orWhere('value', 'like', $search)
                        ->orWhere('meta', 'like', $search)
                        ->orWhere('default', 'like', $search);
                });
            })
            ->tap(fn ($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
            ->paginate(config('common.per_page'));
    }
};
?>

<x-slot name="title">
    {{ __('common.settings') }} - {{ __('common.administrator_panel') }} - {{ config('common.name') }}
</x-slot>


<flux:main>
    <div class="relative mb-6 w-full">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl" level="1">{{ __('common.settings') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('common.settings_description') }}</flux:subheading>
            </div>
            @can('administrator_system_management_setting_create')
                <flux:modal.trigger name="panels.administrator.user-management.user.create.modal">
                    <flux:button variant="primary">{{ __('common.create_user') }}</flux:button>
                </flux:modal.trigger>
            @endcan
        </div>

        <flux:separator variant="subtle" />
    </div>
</flux:main>
