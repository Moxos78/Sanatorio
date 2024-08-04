<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();
        $role3 = Role::create(['name' => 'Super Admin']);

        $user = \App\Models\User::factory()->create([
            'name' => 'Super Usuario',
            'email' => 'fcalvariodelmilagro@gmail.com',
        ]);

        /*\Spatie\Permission\Models\Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
          ]);*/

        $user->assignRole('Super Admin');

        /*$this->call([
            PatientSeeder::class,
        ]);*/

        /*$this->call([
            PatientRecordSeeder::class,
        ]);*/
    }
}
