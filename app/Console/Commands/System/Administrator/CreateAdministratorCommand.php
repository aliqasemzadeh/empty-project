<?php

namespace App\Console\Commands\System\Administrator;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
#[Signature('system:administrator:create-administrator-command')]
#[Description('Command description')]
class CreateAdministratorCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userId = $this->ask('UserID');
        try {
            $user = User::findOrFail($userId);
            foreach (__('roles') as $role => $roleTitle) {
                $user->assignRole($role);
            }
            $this->info('User Created Successfully');
        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }
}
