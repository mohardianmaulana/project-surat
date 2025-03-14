<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class rolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_pelapor = Role::updateOrCreate(['name' => 'pelapor']);
        $role_admin = Role::updateOrCreate(['name' => 'admin']);
        $role_upt = Role::updateOrCreate(['name' => 'upt']);
        

        ////////////////////////////////////////////////////////////////////////////

        $permission = Permission::updateOrCreate(['name' => 'kirim-laporan']);
        $permission2 = Permission::updateOrCreate(['name' => 'meneruskan']);
        $permission3 = Permission::updateOrCreate(['name' => 'mengarsipkan']);
        $permission4 = Permission::updateOrCreate(['name' => 'membalas']);
        $permission5 = Permission::updateOrCreate(['name' => 'membaca']);

        ////////////////////////////////////////////////////////////////////////////

        $role_pelapor -> givePermissionTo($permission);

        $role_admin -> givePermissionTo($permission2);
        $role_admin -> givePermissionTo($permission3);
        $role_admin -> givePermissionTo($permission5);

        $role_upt -> givePermissionTo($permission4);
        $role_upt -> givePermissionTo($permission5);

        

        ////////////////////////////////////////////////////////////////////////////

        $user = User::updateOrCreate(
            ['email' => 'ardi@gmail.com'], 
            [
                'name' => 'Ardi',
                'nim' => '362258302089',
                'nomor' => '6282132945801',
                'password' => bcrypt('12345678'),
            ]
        );

        // Pastikan user mendapat role
        $user->assignRole('pelapor');

        $user1 = User::updateOrCreate(
            ['email' => 'holil@gmail.com'], 
            [
                'name' => 'Holil',
                'nomor' => '08123456789',
                'password' => bcrypt('12345678'),
            ]
        );

        // Pastikan user mendapat role
        $user1->assignRole('admin');

        $user2 = User::updateOrCreate(
            ['email' => 'cahya@gmail.com'], 
            [
                'name' => 'Cahya',
                'nomor' => '08123456731',
                'unit_id' => 1,
                'password' => bcrypt('12345678'),
            ]
        );

        $user2->assignRole('upt');
        // $user  = User::find(1);
        // $user2 = User::find(2);
        // $user3 = User::find(3);

        // $user->assignRole('pelapor');
        // $user2->assignRole('admin');
        // $user3->assignRole('upt');
    }
}