<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = ['Administrator', 'Manager', 'Leader', 'Member'];
        $i = 1;
        foreach($permissions as $permission){
            DB::table('plv')->insert([
                'level'=>$i, 
                'role_name' => $permission
            ]);
            $i++;
            echo $i;
        }
    }
}
