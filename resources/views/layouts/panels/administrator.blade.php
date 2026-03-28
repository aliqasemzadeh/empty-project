<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('common.direction') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('common.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
<flux:sidebar sticky collapsible="mobile" class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.header>
        <flux:sidebar.brand href="{{ route('home') }}" name="{{ config('common.name') }}">
            <x-slot name="logo" class="bg-accent text-accent-foreground">
                <i class="font-serif font-bold">{{ config('common.short_name') }}</i>
            </x-slot>
        </flux:sidebar.brand>
        <flux:sidebar.collapse class="lg:hidden" />
    </flux:sidebar.header>
    <flux:sidebar.search placeholder="Search..." />
    <flux:sidebar.nav>
        <flux:sidebar.item icon="home" href="{{ route('panels.administrator.dashboard.index') }}" wire:navigate>{{ __('common.dashboard') }}</flux:sidebar.item>
        <flux:sidebar.group expandable heading="{{ __('common.user_management') }}" class="grid" :expanded="request()->routeIs('panels.administrator.user-management.*')">
            <flux:sidebar.item href="{{ route('panels.administrator.user-management.user.index') }}" wire:navigate>{{ __('common.users') }}</flux:sidebar.item>
            <flux:sidebar.item href="{{ route('panels.administrator.user-management.permission.index') }}" wire:navigate>{{ __('common.permissions') }}</flux:sidebar.item>
            <flux:sidebar.item href="{{ route('panels.administrator.user-management.role.index') }}" wire:navigate>{{ __('common.roles') }}</flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>
    <flux:sidebar.spacer />
    @include('partials.layouts.panels')
    @include('partials.layouts.user')
    @include('partials.layouts.theme')
</flux:sidebar>
<flux:header class="lg:hidden">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
    <flux:spacer />
    <flux:dropdown position="top" alignt="start">
        <flux:profile avatar="" />
        <flux:menu>
            @include('partials.layouts.radio-menu')
        </flux:menu>
    </flux:dropdown>
</flux:header>
{{ $slot }}

@include('partials.layouts.foot')
</body>
</html>
