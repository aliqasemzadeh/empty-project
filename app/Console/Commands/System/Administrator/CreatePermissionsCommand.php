<?php

namespace App\Console\Commands\System\Administrator;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Signature('system:administrator:create-permissions-command')]
#[Description('Command description')]
class CreatePermissionsCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (__('roles') as $role => $roleTitle) {
            $user = Role::findByName($role);
            $permissions = __('permissions.'.$role);

            foreach ($permissions as $permission => $translate) {
                Permission::firstOrCreate(
                    ['name' => $permission]
                );
            }

            foreach ($permissions as $permission => $translate) {
                $user->givePermissionTo($permission);
            }

        }
        $this->info('Permissions Created Successfully');
    }
}
