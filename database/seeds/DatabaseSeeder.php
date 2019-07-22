<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdvertisesAndTypesSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(AdminsAndRolesSeeder::class);
    }
}
