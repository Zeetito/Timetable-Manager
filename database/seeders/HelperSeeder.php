<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HelperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Give Student department eyi
        foreach(User::staff()->get() as $staff){
            $staff->department_id = $staff->course() ? $staff->course()->department_id : null;
            $staff->save(); 
        }

    }

}
