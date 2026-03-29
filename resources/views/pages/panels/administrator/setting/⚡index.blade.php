<?php

use Livewire\Component;
use Livewire\Attributes\Layout;

new #[Layout('layouts.panels.administrator')] class extends Component
{
    //
};
?>

<x-slot name="title">
    {{ __('common.settings') }} - {{ __('common.administrator_panel') }} - {{ config('common.name') }}
</x-slot>


<div>
    {{-- Happiness is not something readymade. It comes from your own actions. - Dalai Lama --}}
</div>
