<?php
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::auth')] class extends Component
{
    //
};
?>

<div>
    <div class="flex flex-col gap-6">
        <flux:field>
            <flux:label>Email</flux:label>
            <flux:input wire:model="email" type="email" />
            <flux:error name="email" />
        </flux:field>
        <flux:field>
            <div class="mb-3 flex justify-between">
                <flux:label>Password</flux:label>
                <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link>
            </div>
            <flux:input type="password" placeholder="Your password" />
        </flux:field>
        <flux:checkbox label="Remember me for 30 days" />
        <flux:button variant="primary" class="w-full">Log in</flux:button>
    </div>
    <flux:subheading class="text-center">
        First time around here? <flux:link href="#">Sign up for free</flux:link>
    </flux:subheading>
</div>
