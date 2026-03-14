<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <flux:main container>
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#" icon="home" />
            <flux:breadcrumbs.item href="#">Blog</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>Post</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>
        <flux:text class="mt-2 mb-6 text-base">Here's what's new today</flux:text>
        <flux:separator variant="subtle" />
    </flux:main>
</div>
