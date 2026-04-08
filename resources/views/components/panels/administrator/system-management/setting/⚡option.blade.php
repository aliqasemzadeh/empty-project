<?php

use Livewire\Component;

new class extends Component
{
    public \App\Models\System\Setting $setting;
    public $value;
    public function mount(\App\Models\System\Setting $setting)
    {
        $this->setting = $setting;
        $this->value = $this->setting->value;
    }

    public function save()
    {
        $this->setting->set($this->value);
        \Flux\Flux::toast(__('common.saved'));
    }
};
?>

<flux:card class="mt-6" :key="$setting->id">
    <flux:heading size="lg">{{ $setting->translate ?: $setting->name }}</flux:heading>
    <form wire:submit.prevent="save">
        @if($setting->type === 'string')
            <flux:field>
                <flux:label>Username</flux:label>
                <flux:description>This will be publicly displayed.</flux:description>
                <flux:input wire:model="value" type="text" />
                <flux:error name="username" />
            </flux:field>
        @endif
        @if($setting->type === 'text')
            <flux:field>
                <flux:label>Username</flux:label>
                <flux:description>This will be publicly displayed.</flux:description>
                <flux:textarea wire:model="value" />
                <flux:error name="username" />
            </flux:field>
        @endif
        @if($setting->type === 'boolean')
            <flux:field variant="inline">
                <flux:label>Enable notifications</flux:label>
                <flux:switch  wire:model="value" />
                <flux:error name="notifications" />
            </flux:field>
        @endif
        <div class="flex gap-4">
            <flux:spacer />
            <flux:button type="submit">{{ __('common.save') }}</flux:button>
        </div>
    </form>
</flux:card>
