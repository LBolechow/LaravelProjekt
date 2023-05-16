<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user =  \App\Models\User::factory()->create([
            'name' => 'Nauczyciel',
            'email' => 'nauczyciel@pans.nysa.pl',
       ]);
       $user->assignRole('nauczyciel');
    }
}
