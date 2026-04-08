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
    @include('partials.layouts.header')
    @include('partials.layouts.search')
    <flux:sidebar.nav>
        <flux:sidebar.item icon="layout-dashboard" href="{{ route('panels.user.dashboard.index') }}" :current="request()->routeIs('panels.user.*') || request()->routeIs('home')" wire:navigate>{{ __('common.dashboard') }}</flux:sidebar.item>
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
        </flux:menu>
    </flux:dropdown>
</flux:header>
{{ $slot }}

@include('partials.layouts.foot')
</body>
</html>
