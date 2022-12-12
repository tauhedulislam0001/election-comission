<?php

use App\AdminUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Roles
        $roleSuperAdmin = Role::create(['name' => 'Super Admin']);
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleUser = Role::create(['name' => 'User']);
        $roleSuperSoleDistributer = Role::create(['name' => 'Super Sole Distributer']);
        $roleAdminSoledistributor = Role::create(['name' => 'Admin Sole distributor']);
        $roleSoleDistributer = Role::create(['name' => 'User Sole Distributer']);
        $roleAgentTypeA = Role::create(['name' => 'Agent Type A']);
        $roleAgentTypeB = Role::create(['name' => 'Agent Type B']);
        $roleServiceProvider = Role::create(['name' => 'Service Provider']);
        $roleCustomer = Role::create(['name' => 'Customer']);

        // Create Permission List as array
        $permissions = [

            //Dashboard permission
            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                ]
            ],

            // visit_site permissions
            [
                'group_name' => 'visit_site',
                'permissions' => [
                    'visit_site.view',
                ]
            ],

            // permissions
            [
                'group_name' => 'permission',
                'permissions' => [
                    'permission.create',
                    'permission.view',
                    'permission.edit',
                    'permission.delete',
                ]
            ],

            //role permission
            [
                'group_name' => 'role',
                'permissions' => [
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                ]
            ],

            //all admin_user permission
            [
                'group_name' => 'all_admin_user',
                'permissions' => [
                    'admin_user.create',
                    'admin_user.view',
                    'admin_user.edit',
                    'admin_user.delete',
                ]
            ],

            //all admin permission
            [
                'group_name' => 'admin',
                'permissions' => [
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                ]
            ],

            //all user permission
            [
                'group_name' => 'user',
                'permissions' => [
                    'user.create',
                    'user.view',
                    'user.edit',
                    'user.delete',
                ]
            ],

            //sole_distributor permission
            [
                'group_name' => 'all_sole_distributor',
                'permissions' => [
                    'all_sole_distributor.view',
                    'all_sole_distributor.edit',
                ]
            ],

            //super sole distributor permission
            [
                'group_name' => 'super_sole_distributor',
                'permissions' => [
                    'super_sole_distributor.create',
                    'super_sole_distributor.view',
                    'super_sole_distributor.edit',
                    'super_sole_distributor.delete',
                    'super_sole_distributor.approve',
                ]
            ],

            //admin sole distributor permission
            [
                'group_name' => 'admin_sole_distributor',
                'permissions' => [
                    'admin_sole_distributor.create',
                    'admin_sole_distributor.view',
                    'admin_sole_distributor.edit',
                    'admin_sole_distributor.delete',
                ]
            ],

            //user sole distributor permission
            [
                'group_name' => 'user_sole_distributor',
                'permissions' => [
                    'user_sole_distributor.create',
                    'user_sole_distributor.view',
                    'user_sole_distributor.edit',
                    'user_sole_distributor.delete',
                ]
            ],

            //all agent permission
            [
                'group_name' => 'all_agent',
                'permissions' => [
                    'agent.view',
                ]
            ],

            //agent type a permission
            [
                'group_name' => 'agent_type_a',
                'permissions' => [
                    'agent_type_a.create',
                    'agent_type_a.view',
                    'agent_type_a.edit',
                    'agent_type_a.delete',
                    'agent_type_a.credit_form',
                    'agent_type_a.approve',
                ]
            ],

            //agent type b permission
            [
                'group_name' => 'agent_type_b',
                'permissions' => [
                    'agent_type_b.create',
                    'agent_type_b.view',
                    'agent_type_b.edit',
                    'agent_type_b.delete',
                    'agent_type_b.credit_form',
                    'agent_type_b.approve',
                ]
            ],

            //all agent permission
            [
                'group_name' => 'request_agent',
                'permissions' => [
                    'request_agent.view',
                    'request_agent.approve',
                ]
            ],

            //customer permission
            [
                'group_name' => 'customer',
                'permissions' => [
                    'customer.view',
                    'customer.edit',
                    'customer.delete',
                ]
            ],

            //Service Providers permission
            [
                'group_name' => 'service_providers',
                'permissions' => [
                    'service_providers.create',
                    'service_providers.view',
                    'service_providers.edit',
                    'service_providers.delete',
                    'service_providers.approve',
                ]
            ],

            //carbook permission
            [
                'group_name' => 'carbook',
                'permissions' => [
                    'carbook.create',
                    'carbook.view',
                    'carbook.edit',
                    'carbook.assign',
                    'carbook.details',
                    'carbook.approve',
                ]
            ],

            //assigned provider carbook permission
            [
                'group_name' => 'provider_carbook',
                'permissions' => [
                    'provider_carbook.view',
                ]
            ],

            // deposit list permission
            [
                'group_name' => 'deposit',
                'permissions' => [
                    'deposit.view',
                    'deposit.reject',
                    'deposit.received',
                ]
            ],

            // wallet list permission
            [
                'group_name' => 'wallet',
                'permissions' => [
                    'wallet.view',
                    'wallet.received',
                ]
            ],

            // airlines list permission
            [
                'group_name' => 'airlines',
                'permissions' => [
                    'airlines.create',
                    'airlines.view',
                    'airlines.edit',
                    'airlines.delete',
                ]
            ],

            //  division list permission
            [
                'group_name' => 'division',
                'permissions' => [
                    'division.create',
                    'division.view',
                    'division.edit',
                    'division.delete',
                ]
            ],

            // district list permission
            [
                'group_name' => 'district',
                'permissions' => [
                    'district.create',
                    'district.view',
                    'district.edit',
                    'district.delete',
                ]
            ],

            // settings thana list permission
            [
                'group_name' => 'thana',
                'permissions' => [
                    'thana.create',
                    'thana.view',
                    'thana.edit',
                    'thana.delete',
                ]
            ],

            // settings car_type list permission
            [
                'group_name' => 'car_type',
                'permissions' => [
                    'car_type.create',
                    'car_type.view',
                    'car_type.edit',
                    'car_type.delete',
                ]
            ],

            // airport list permission
            [
                'group_name' => 'airport',
                'permissions' => [
                    'airport.create',
                    'airport.view',
                    'airport.edit',
                    'airport.delete',
                ]
            ],

            // settings single_trip_rent list permission
            [
                'group_name' => 'single_trip_rent',
                'permissions' => [
                    'single_trip_rent.create',
                    'single_trip_rent.view',
                    'single_trip_rent.edit',
                    'single_trip_rent.delete',
                ]
            ],

            // settings round_trip_rent list permission
            [
                'group_name' => 'round_trip_rent',
                'permissions' => [
                    'round_trip_rent.create',
                    'round_trip_rent.view',
                    'round_trip_rent.edit',
                    'round_trip_rent.delete',
                ]
            ],

            // settings agent_commission list permission
            [
                'group_name' => 'agent_commission',
                'permissions' => [
                    'agent_commission.create',
                    'agent_commission.view',
                    'agent_commission.edit',
                    'agent_commission.delete',
                    'agent_commission.approve',
                ]
            ],
        ];

        //Create and assign permissions
        for ($i = 0; $i < count($permissions); $i++) {
            $permissionsGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                //create permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionsGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }
    }
}
