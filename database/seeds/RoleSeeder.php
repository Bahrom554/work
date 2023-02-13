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
        $admin= Role::create(['name' =>User::ROLE_ADMIN]);
        $manager=Role::create(['name' =>User::ROLE_MANAGER]);
        $worker=Role::create(['name' =>User::ROLE_USER]);
        $users=Factory(User::class,30)->create();
        foreach($users as $user){
            if($user->id==1){
                $user->assignRole($admin);
            }
            else if($user->id==2){
                $user->assignRole($manager);
            }
            else{
                $user->assignRole($worker);
            }
        }
       
        
    }
}
