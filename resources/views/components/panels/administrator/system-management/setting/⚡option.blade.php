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
    <form wire:submit.prevent="save">
        @if($setting->type === 'string')
            <flux:field>
                <flux:label>{{ $setting->translate ?: $setting->name }}</flux:label>
                <flux:description>This will be publicly displayed.</flux:description>
                <flux:input wire:model="value" type="text" />
                <flux:error name="value" />
            </flux:field>
        @endif
        @if($setting->type === 'text')
            <flux:field>
                <flux:label>{{ $setting->translate ?: $setting->name }}</flux:label>
                <flux:description>This will be publicly displayed.</flux:description>
                <flux:textarea wire:model="value" />
                <flux:error name="value" />
            </flux:field>
        @endif
        @if($setting->type === 'boolean')
            <flux:field variant="inline">
                <flux:switch  wire:model="value" />
                <flux:label>{{ $setting->translate ?: $setting->name }}</flux:label>
                <flux:error name="value" />
            </flux:field>
        @endif
        <div class="flex gap-4 mt-2">
            <flux:spacer />
            <flux:button type="submit" variant="primary">{{ __('common.save') }}</flux:button>
        </div>
    </form>
</flux:card>
