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
    }
};
?>

<div>
    <flux:heading class="text-center" size="xl">{{ __('common.register') }}</flux:heading>
        <form wire:submit="register" class="flex flex-col gap-6">
            <flux:input name="name" wire:model="name" label="{{ __('common.name') }}" type="text" placeholder="{{ __('common.your_name') }}" />
            <flux:input name="email" wire:model="email" label="{{ __('common.email') }}" type="email" placeholder="email@example.com" />
            <flux:field>
                <div class="mb-3 flex justify-between">
                    <flux:label>{{ __('common.password') }}</flux:label>
                    <flux:link href="#" variant="subtle" class="text-sm">{{ __('common.forget_password') }}</flux:link>
                </div>
                <flux:input name="password" wire:model="password"  type="password" placeholder="{{ __('common.your_password') }}" viewable />
            </flux:field>
            <flux:button variant="primary" class="w-full" type="submit">{{ __('common.register') }}</flux:button>
        </form>
</div>
