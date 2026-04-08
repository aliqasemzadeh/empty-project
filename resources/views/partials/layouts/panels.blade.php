<flux:sidebar.nav>
    <flux:sidebar.item icon="user" href="{{ route('panels.user.dashboard.index') }}" wire:navigate :current="request()->routeIs('panels.user.*') || request()->routeIs('home')">{{ __('common.user_panel') }}</flux:sidebar.item>
    @can('administrator_access')
        <flux:sidebar.item icon="shield-user" href="{{ route('panels.administrator.dashboard.index') }}" wire:navigate :current="request()->routeIs('panels.administrator.*')">{{ __('common.administrator_panel') }}</flux:sidebar.item>
    @endcan
</flux:sidebar.nav>
