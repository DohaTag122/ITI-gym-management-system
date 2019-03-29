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
        
        $this->call('CountriesSeeder');
        $this->command->info('Seeded the countries!');  

        $this->call([UsersTableSeeder::class, RolesAndPermissionsSeeder::class, CountriesSeeder::class]);
        factory(App\City::class, 13)->create();
        factory(App\Gym::class, 25)->create();
        factory(App\Coach::class, 40)->create();

    }
}