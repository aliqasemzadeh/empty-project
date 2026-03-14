<?php

use App\Livewire\Forms\Auth\LogoutForm;
use Livewire\Attributes\Layout;
use Livewire\Component;

new #[Layout('layouts::auth')] class extends Component
{
    public LogoutForm $logoutForm;

    public function logout()
    {
        $this->logoutForm->logout();
        return $this->redirectRoute('login', navigate: true);
    }


    public function cancel()
    {
        return $this->redirect(url()->previous(), navigate: true);
    }
};
?>

<div>

    <form wire:submit="logout" class="flex flex-col gap-6">
        <flux:heading class="text-center" size="xl">{{ __('common.logout') }}</flux:heading>
        <flux:button variant="primary" color="red" class="w-full" type="submit">{{ __('common.logout') }}</flux:button>
        <flux:button variant="ghost" color="green" class="w-full" type="button" wire:click="cancel">{{ __('common.cancel') }}</flux:button>
    </form>
</div>
