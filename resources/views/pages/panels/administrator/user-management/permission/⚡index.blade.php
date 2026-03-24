<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    //
};
?>

<x-slot name="title">
    {{ __('common.permissions') }}
</x-slot>


<div>
    {{-- Simplicity is the ultimate sophistication. - Leonardo da Vinci --}}
</div>
