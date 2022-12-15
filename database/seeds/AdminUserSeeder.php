<?php

use Illuminate\Database\Seeder;
use App\AdminUser;
use Illuminate\Support\Facades\Hash;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = AdminUser::where('email', 'systemadmin@gmail.com')->first();
        if (is_null($superAdmin)) {
            $adminUser = new AdminUser();
            $adminUser->username = "System Admin";
            $adminUser->email = "systemadmin@gmail.com";
            $adminUser->password = Hash::make('123456');
            $adminUser->user_type = 1;
            $adminUser->can_login = 1;
            $adminUser->role_id = 1;
            $adminUser->save();
            $adminUser->roles()->detach();
            $adminUser->assignRole(1);
        }
    }
}
