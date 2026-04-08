<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    public string $site_name = "";


    public function save()
    {

    }
};
?>

<x-slot name="title">
    {{ __('common.settings') }} - {{ __('common.administrator_panel') }} - {{ config('common.name') }}
</x-slot>


<flux:main>
        <flux:button wire:click="save()">Save</flux:button>
</flux:main>
