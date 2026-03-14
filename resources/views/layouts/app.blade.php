<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ __('common.direction') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxAppearance
    @livewireStyles
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">
<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>
    <flux:brand href="#" logo="" name="Acme Inc."
                class="max-lg:hidden dark:hidden"/>
    <flux:brand href="#" logo="" name="Acme Inc."
                class="max-lg:hidden! hidden dark:flex"/>
    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item icon="home" href="#" current>Home</flux:navbar.item>
        <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>
        <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>
        <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>
    </flux:navbar>
    <flux:spacer/>
    <flux:navbar class="me-4">
        <flux:navbar.item x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" />
    </flux:navbar>
    <flux:dropdown position="top" align="start">
        <flux:profile />
        <flux:menu>
            <flux:menu.item href="{{ route('register') }}" icon="user-plus">{{ __('common.register') }}</flux:menu.item>
            <flux:menu.item href="{{ route('login') }}" icon="arrow-left-start-on-rectangle">{{ __('common.login') }}</flux:menu.item>
        </flux:menu>
    </flux:dropdown>
</flux:header>
<flux:sidebar sticky collapsible="mobile"
              class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.header>
        <flux:sidebar.brand
            href="#"
            name="{{ config('app.name') }}"
        />
        <flux:sidebar.collapse
            class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2"/>
    </flux:sidebar.header>
    <flux:sidebar.nav>
        <flux:sidebar.item icon="home" href="#" current>Home</flux:sidebar.item>
        <flux:sidebar.item icon="inbox" badge="12" href="#">Inbox</flux:sidebar.item>
        <flux:sidebar.item icon="document-text" href="#">Documents</flux:sidebar.item>
        <flux:sidebar.item icon="calendar" href="#">Calendar</flux:sidebar.item>
    </flux:sidebar.nav>
    <flux:sidebar.spacer/>
    <flux:sidebar.nav>
        <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
        <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
    </flux:sidebar.nav>
</flux:sidebar>
{{ $slot }}


@livewireScripts
@fluxScripts
</body>
</html>
