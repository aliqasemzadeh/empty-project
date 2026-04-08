<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    public string $search =  '';
    public string $group = 'general';

    protected $queryString = [
        'search' => ['except' => ''],
        'group' => ['except' => 'general'],
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
    public function settings()
    {
        return \App\Models\System\Setting::query()
            ->when($this->group, fn($query) => $query->where('group', $this->group))
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
            ->orderBy($this->sortBy, $this->sortDirection)
            ->get();
    }

    public function saveSetting()
    {

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

    <div>
        <flux:input.group>
            <flux:select class="max-w-fit" wire:model.live="group">
                @foreach(__('settings') as $group_key => $group)
                    <flux:select.option value="{{ $group_key }}">{{ $group['title'] }}</flux:select.option>
                @endforeach
            </flux:select>
            <flux:input placeholder="{{ __('common.search_placeholder') }}" wire:model.live="search" />
        </flux:input.group>
    </div>

    @foreach ($this->settings as $setting)
        <livewire:panels.administrator.system-management.setting.option :setting="$setting" :key="$setting->id" />
    @endforeach
</flux:main>
