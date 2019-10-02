<?php
  
use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
  
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
	    	User::create([
	            'email' => "jesus@gmail.com",
                'name'=>"Jesus Luna",
	            'type' => 1,
                'status' => 1,
	            'password' => bcrypt('123456')
	        ]);

            User::create([
                'email' => "fer@gmail.com",
                'name'=>"Fernanda Macias",
                'type' => 2,
                'status' => 1,
                'password' => bcrypt('654321')
            ]);
    	
    }
}