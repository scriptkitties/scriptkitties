<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Eloquent::unguard();

		$this->call('UserTableSeeder');
	}

}

class UserTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->insert([
			'nickname' => 'root',
			'password' => Hash::make('password'),
			'email'    => 'root@localhost',
			'website'  => 'localhost'
		]);
	}
}
