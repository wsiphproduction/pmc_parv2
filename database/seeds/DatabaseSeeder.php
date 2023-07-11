<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
    		'fullName' => 'Philsaga Admin',
	        'domainAccount' => 'admin',
	        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
	        'role' => 'admin',
	        'dept' => 'Information Communications Technology',
	        'isActive' => 1,
	        'isLocked' => 0,
	        'addedBy'  => 'default',
	        'lockedOn' => '',
	        'email' => 'pmc_admin@philsaga.com',     
	        'remember_token' => Str::random(10),
    	]);
 
    }
}
