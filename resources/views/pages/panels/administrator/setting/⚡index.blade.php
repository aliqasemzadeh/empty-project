<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    public string $app_name = "";

    public function mount(App\Settings\GeneralSettings $generalSettings)
    {
        $this->app_name = $generalSettings->app_name;
    }

    public function save(App\Settings\GeneralSettings $generalSettings)
    {
        $generalSettings->app_name = "PCShiraz";
        $generalSettings->app_short_name = "PC";
        $generalSettings->app_domain = "PCShiraz.ir";
        $generalSettings->app_description = "PCShiraz";
        $generalSettings->save();
        $this->app_name = $generalSettings->app_name;
    }
};
?>

<x-slot name="title">
    {{ __('common.settings') }} - {{ __('common.administrator_panel') }} - {{ config('common.name') }}
</x-slot>


<flux:main>
        <flux:button wire:click="save()">Save</flux:button>
</flux:main>
