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
		$this->call('PageSeeder');
	}

}

class UserTableSeeder extends Seeder {
	public function run() {
		$id = DB::table('users')->insertGetId([
			'nickname'   => 'root',
			'password'   => Hash::make('password'),
			'email'      => 'root@localhost',
			'website'    => 'localhost',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		DB::table('permissions')->insert([
			'user_id'    => $id,
			'bbs'        => 7,
			'pages'      => 7,
			'user'       => 7,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		DB::table('preferences')->insert([
			'user_id'    => $id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
	}
}

class PageSeeder extends Seeder {
	public function run() {
		DB::table('pages')->insert([
			'page'       => 'about',
			'content'    => 'Placeholder',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		DB::table('pages')->insert([
			'page'       => 'irc',
			'content'    => 'Placeholder',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
	}
}

