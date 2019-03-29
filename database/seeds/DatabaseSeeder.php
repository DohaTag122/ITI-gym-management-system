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
        // $this->call(UsersTableSeeder::class);
        //Seed the countries
        // $this->command->info('Seeded the countries!');
        $this->call([RolesAndPermissionsSeeder::class, UsersTableSeeder::class, CountriesSeeder::class]);
        factory(App\City::class, 13)->create();
        factory(App\Gym::class, 25)->create();
        factory(App\Coach::class, 40)->create();

    }
}