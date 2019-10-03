<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Enums\Role as RoleEnum;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function createPermissions()
    {
        $collection = collect([
            'user',
            'role',
            'permission',
            'bank',
            'beneficiary',
            'currency',
            'faq',
            'promotion',
            'store',
            'transaction',
            'verification',
            'point',
            'profile',
            'address',
        ]);

        $collection->each(function ($item) {
            // create permissions for each collection item
            Permission::create(['group' => $item, 'name' => 'view any ' . Str::plural($item)]);
            Permission::create(['group' => $item, 'name' => 'view ' . $item]);
            Permission::create(['group' => $item, 'name' => 'create ' . $item]);
            Permission::create(['group' => $item, 'name' => 'update ' . $item]);
            Permission::create(['group' => $item, 'name' => 'delete ' . $item]);
            Permission::create(['group' => $item, 'name' => 'restore ' . $item]);
            Permission::create(['group' => $item, 'name' => 'force delete ' . $item]);
        });
    }

    public function createRoles()
    {
        $roles = [
            ['name' => RoleEnum::SUPER_ADMIN()],
            ['name' => RoleEnum::ADMIN()],
        ];

        foreach ($roles as $role) {
            Role::forceCreate($role);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->createPermissions();
        $this->createRoles();

        // Create a Super-Admin Role and assign all Permissions
        $role = Role::where('name', RoleEnum::SUPER_ADMIN())->first();
        $role->givePermissionTo(Permission::all());

        // Give User Super-Admin Role
        $user = App\Models\User::forceCreate([
            'first_name' => 'Xenon',
            'last_name' => 'Thong',
            'email' => 'xenonthong@gmail.com',
            'password' => Hash::make('pass')
        ]);

        $user->assignRole((string) RoleEnum::SUPER_ADMIN());
    }
}
