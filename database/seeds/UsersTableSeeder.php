<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory(User::class)->create([
			       'email' => 'teacher@gonzaga.ac.tz',
             'fruits' => json_encode(['oranges', 'banana'])
	         ]);
    }
}
