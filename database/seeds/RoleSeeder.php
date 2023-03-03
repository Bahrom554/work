<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role= Role::create(['name' =>User::ROLE_ADMIN]);
        $manager_role=Role::create(['name' =>User::ROLE_MANAGER]);
        $worker_role=Role::create(['name' =>User::ROLE_USER]);
        $users=Factory(User::class,30)->create();
        $admin=User::create([ 
        'name' => 'admin',
        'email' => 'superadmin@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10)]);
        $manager=User::create([
        'name' => 'manager',
        'email' => 'manager@gmail.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10)
        ]);
        $admin->assignRole($admin_role);
        $manager->assignRole($manager_role);

        foreach($users as $user){
        $user->assignRole($worker_role);
        }
       
        
    }
}
