<?php

namespace App\Console\Commands\System\Administrator;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

#[Signature('system:administrator:create-roles-command')]
#[Description('Command description')]
class CreateRolesCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Permission::truncate();
        DB::table('role_has_permissions')->truncate();
        Schema::enableForeignKeyConstraints();

        foreach (__('roles') as $role => $roleTitle) {
            Role::create(['name' => $role]);
        }

        $this->info('Roles Created Successfully');
    }
}
