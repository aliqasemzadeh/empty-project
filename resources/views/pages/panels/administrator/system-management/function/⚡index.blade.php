<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    //
};
?>
<x-slot name="title">
    {{ __('common.functions') }} - {{ __('common.administrator_panel') }} - {{ config('common.name') }}
</x-slot>


<flux:main>
    <div class="relative mb-6 w-full">
        <div class="flex items-center justify-between">
            <div>
                <flux:heading size="xl" level="1">{{ __('common.functions') }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">{{ __('common.functions_description') }}</flux:subheading>
            </div>
        </div>

        <flux:separator variant="subtle" />
    </div>
</flux:main>
