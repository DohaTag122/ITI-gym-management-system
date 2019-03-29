<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\seeds\AdminSeeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');  

        $this->call([UsersTableSeeder::class, RolesAndPermissionsSeeder::class, CountriesSeeder::class]);
=======
        // $this->call(UsersTableSeeder::class);
        //Seed the countries
        // $this->command->info('Seeded the countries!');
        $this->call([RolesAndPermissionsSeeder::class, UsersTableSeeder::class, CountriesSeeder::class]);
>>>>>>> fe563fb186d2805eec92b13a0aa2ce21f0758a2c
        factory(App\City::class, 13)->create();
        factory(App\Gym::class, 25)->create();
        factory(App\Coach::class, 40)->create();

    }
}