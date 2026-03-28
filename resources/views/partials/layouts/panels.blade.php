<flux:sidebar.nav>
    <flux:sidebar.item icon="cog-6-tooth" href="{{ route('settings.profile-information') }}">{{ __('common.setting_panel') }}</flux:sidebar.item>
    <flux:sidebar.item icon="user" href="#">{{ __('common.user_panel') }}</flux:sidebar.item>
    @can('administrator_access')
        <flux:sidebar.item icon="shield-user" href="{{ route('panels.administrator.user-management.user.index') }}">{{ __('common.administrator_panel') }}</flux:sidebar.item>
    @endcan

</flux:sidebar.nav>
