<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    public string $site_name = "";

    public function mount(App\Settings\GeneralSettings $generalSettings)
    {
        $this->site_name = $generalSettings->site_name;
    }

    public function save(App\Settings\GeneralSettings $generalSettings)
    {
        $generalSettings->site_name = $this->site_name;
        $generalSettings->site_url = "https://PCShiraz.ir";
        $generalSettings->site_description = "PCShiraz";
        $generalSettings->save();
        $this->site_name = $generalSettings->site_name;
    }
};
?>

<x-slot name="title">
    {{ __('common.settings') }} - {{ __('common.administrator_panel') }} - {{ config('common.name') }}
</x-slot>


<flux:main>
        <flux:button wire:click="save()">Save</flux:button>
</flux:main>
