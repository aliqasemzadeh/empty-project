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
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>

        <flux:brand href="#" name="{{ config('common.name') }}">
            <x-slot name="logo" class="bg-accent text-accent-foreground">
                <i class="font-serif font-bold">PC</i>
            </x-slot>
        </flux:brand>

        <flux:navbar class="-mb-px me-4 max-lg:hidden">
            <flux:navbar.item icon="home" href="#">Home</flux:navbar.item>
            @guest
                <flux:navbar.item icon="arrow-left-start-on-rectangle" href="{{ route('login') }}">{{ __('common.login') }}</flux:navbar.item>
                <flux:navbar.item icon="user" href="{{ route('register') }}">{{ __('common.register') }}</flux:navbar.item>
            @endguest
        </flux:navbar>
        <flux:spacer/>
        <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" />
        <flux:dropdown position="top" align="start">
            <flux:profile />
            <flux:menu>
                @guest
                    <flux:menu.item href="{{ route('register') }}" icon="">{{ __('common.register') }}</flux:menu.item>
                    <flux:menu.item href="{{ route('login') }}" icon="arrow-left-start-on-rectangle">{{ __('common.login') }}</flux:menu.item>
                @endguest

                @auth
                        <flux:menu.item href="{{ route('logout') }}" icon="arrow-right-start-on-rectangle">{{ __('common.logout') }}</flux:menu.item>
                @endauth
            </flux:menu>
        </flux:dropdown>
    </flux:header>
    <flux:sidebar sticky collapsible="mobile"
                  class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.header>
            <flux:sidebar.brand
                href="#"
                name="{{ config('common.name') }}"
            />
            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2"/>
        </flux:sidebar.header>
        <flux:sidebar.nav>
            <flux:sidebar.item icon="home" href="#" current>Home</flux:sidebar.item>
        </flux:sidebar.nav>
        <flux:sidebar.spacer/>
        @include('partials.panels')
    </flux:sidebar>
    {{ $slot }}
    @include('partials.layouts.foot')
</body>
</html>
