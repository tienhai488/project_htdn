<?php

use App\Acl\Acl;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (Acl::roles() as $role) {
            Role::findOrCreate($role);
        }

        foreach (Acl::permissions() as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $adminRole = Role::findByName(Acl::ROLE_ADMIN);
        $hrRole = Role::findByName(Acl::ROLE_HR);
        $warehouseRole = Role::findByName(Acl::ROLE_WAREHOUSE);
        $businessRole = Role::findByName(Acl::ROLE_BUSINESS);
        $staffRole = Role::findByName(Acl::ROLE_STAFF);

        $adminRole->givePermissionTo(Acl::permissions());
        $hrRole->givePermissionTo(Acl::rolePermissions([], Acl::ROLE_HR));
        $warehouseRole->givePermissionTo(Acl::rolePermissions([], Acl::ROLE_WAREHOUSE));
        $businessRole->givePermissionTo(Acl::rolePermissions([], Acl::ROLE_BUSINESS));
        $staffRole->givePermissionTo([]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};