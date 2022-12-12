<?php

use Illuminate\Database\Seeder;
use App\AdminUser;
use App\RoleHasPermissionModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Contracts\Role;
use Spatie\Permission\Models\Permission;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i = 1; $i <= 76; $i++) {
        //     DB::table('role_has_permissions')->insert([
        //         'permission_id' => $i, 'role_id' => 1
        //     ]);
        // }

        $superAdmin = AdminUser::where('email', 'systemadmin@garibook.com')->first();
        if (is_null($superAdmin)) {
            $adminUser = new AdminUser();
            $adminUser->username = "System Admin";
            $adminUser->email = "systemadmin@garibook.com";
            $adminUser->password = Hash::make('12345678');
            // $adminUser->role_id = 1;
            $adminUser->user_type = 1;
            $adminUser->can_login = 1;
            $adminUser->role_id = 1;
            $adminUser->save();
            $adminUser->roles()->detach();
            $adminUser->assignRole(7);

        }
    }
}
