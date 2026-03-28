<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.panels.user')] class extends Component
{
    //
};
?>

<x-slot name="title">
    {{ __('common.dashboard') }}
</x-slot>


<flux:main>
    {{-- Do what you can, with what you have, where you are. - Theodore Roosevelt --}}
</flux:main>
