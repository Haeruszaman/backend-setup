<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('BackendSetupTableSeeder');
    }
}

class BackendSetupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$jumlah_user_role = 6;
		$jumlah_users = 2;
		
    	DB::table('user_role')->truncate();
		DB::table('users')->truncate();

        $faker = Faker::create();
        $faker_users = Faker::create();

		foreach (range(1,$jumlah_user_role) as $key => $value) 
		{

        	$roles = $faker->unique()->randomElement(['System', 'Manager', 'Coordinator', 'Internal Observer', 'Legal Observer', 'Field Owner']);
            DB::table('user_role')->insert([
                'name' => $roles,
        	]);
            
            foreach (range(1,$jumlah_users) as $key => $value) {

				$user = $faker_users->unique()->userName;
                DB::table('users')->insert([
					'register_time' => $faker_users->DateTime,
					'pin' => $faker_users->numberBetween(1000,5000),
                    'username' => $user,
                    'password' => $faker_users->randomElement(['$2y$10$vr6ZIP3Jp1g2YHn5VSSFkuaUKsJXHTmkfU3cM5EpFtQ7HSp1wfbna']),
                    'name' => $faker_users->lastName,
                    'image' => $faker_users->randomElement(['1.jpg','2.jpg','3.jpg', '4.jpg']),
                    'email' => $faker_users->email,
                    'phone' => $faker_users->phoneNumber,
                    'secretcode' => $faker_users->sha256,
                    'status' => $faker_users->numberBetween(0,-1,1),
                    'roles' => $roles,
                    'remember_token' => $faker_users->swiftBicNumber,
				]);
				
			}
		}
	}

}