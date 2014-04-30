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
		$this->call('BbsTableSeeder');
	}

}

class UserTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->insert([
			'nickname' => 'root',
			'password' => Hash::make('password'),
			'email'    => 'root@localhost',
			'website'  => 'localhost',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
	}
}

class BbsTableSeeder extends Seeder {
	public function run() {
		$board = DB::table('bbs_boards')->insertGetId([
			'name'        => 't',
			'description' => 'This is a testboard.',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		$parent = DB::table('bbs_posts')->insertGetId([
			'board_id'  => $board,
			'parent_id' => null,
			'author'    => 1,
			'file'      => null,
			'content'   => 'This is a testpost.',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
		DB::table('bbs_posts')->insert([
			'board_id'  => $board,
			'parent_id' => $parent,
			'author'    => 1,
			'content'   => 'This is a reply to post #'.$parent.'.',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
		]);
	}
}
