<flux:sidebar.nav>
    <flux:sidebar.item icon="user" href="{{ route('panels.user.dashboard.index') }}" wire:navigate>{{ __('common.user_panel') }}</flux:sidebar.item>
    @can('administrator_access')
        <flux:sidebar.item icon="shield-user" href="{{ route('panels.administrator.user-management.user.index') }}" wire:navigate>{{ __('common.administrator_panel') }}</flux:sidebar.item>
    @endcan
</flux:sidebar.nav>
