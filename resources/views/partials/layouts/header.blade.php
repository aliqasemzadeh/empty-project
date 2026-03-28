<flux:sidebar.header>
    <flux:sidebar.brand href="{{ route('home') }}" name="{{ config('common.name') }}">
        <x-slot name="logo" class="bg-accent text-accent-foreground">
            <i class="font-serif font-bold">{{ config('common.short_name') }}</i>
        </x-slot>
    </flux:sidebar.brand>
    <flux:sidebar.collapse class="lg:hidden" />
</flux:sidebar.header>
