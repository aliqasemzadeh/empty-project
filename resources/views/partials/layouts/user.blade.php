@auth
<flux:dropdown position="top" align="start">
    <flux:sidebar.profile avatar="" name="{{ auth()->user()->name }}" />
    <flux:menu>
        @include('partials.layouts.radio-menu')
    </flux:menu>
</flux:dropdown>
@endauth
