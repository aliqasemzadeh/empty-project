<?php
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Livewire\Forms\Auth\RegisterForm;

new #[Layout('layouts::auth')] class extends Component
{
    public RegisterForm $registerForm;

    public function register()
    {
        $this->registerForm->register();
        return $this->redirectIntended(default: route('home'));
    }
};
?>

<div>
    <flux:heading class="text-center" size="xl">{{ __('common.register') }}</flux:heading>
        <form wire:submit="register" class="flex flex-col gap-6">
            <flux:input name="registerForm.name" wire:model="registerForm.name" label="{{ __('common.name') }}" type="text" placeholder="{{ __('common.your_name') }}" />
            <flux:input name="registerForm.email" wire:model="registerForm.email" label="{{ __('common.email') }}" type="email" placeholder="email@example.com" />
            <flux:field>
                <div class="mb-3 flex justify-between">
                    <flux:label>{{ __('common.password') }}</flux:label>
                    <flux:link href="#" variant="subtle" class="text-sm">{{ __('common.forget_password') }}</flux:link>
                </div>
                <flux:input name="registerForm.password" wire:model="registerForm.password"  type="password" placeholder="{{ __('common.your_password') }}" viewable />
                <flux:error name="registerForm.password" />
            </flux:field>
            <flux:button variant="primary" class="w-full" type="submit">{{ __('common.register') }}</flux:button>
        </form>
    <flux:subheading class="text-center">
        {{ __('common.register_before') }} <flux:link href="{{ route('login') }}">{{ __('common.login_here') }}</flux:link>
    </flux:subheading>
</div>
