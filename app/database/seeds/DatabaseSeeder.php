<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        // $this->call('UserSeeder');
    }

}

class UserSeeder extends Seeder
{
    public function run()
    {
        // Seed a root user
    }
}

