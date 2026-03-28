<flux:dropdown position="top" align="start">
    <flux:sidebar.profile avatar="" name="Olivia Martin" />
    <flux:menu>
        @include('partials.layouts.radio-menu')
        <flux:menu.item href="{{ route('logout') }}" icon="arrow-right-start-on-rectangle">{{ __('common.logout') }}</flux:menu.item>
    </flux:menu>
</flux:dropdown>
