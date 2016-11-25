<?php

use Illuminate\Database\Seeder;

/**
 * Class UsersSeeder
 */
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            factory(App\User::class)->create([
                    "name" => "Marc Calafell",
                    "email" => "mcalafellsmx@gmail.com",
                    "password" => bcrypt(env('pass', '12345678'))]
            );
        } catch (\Illuminate\Database\QueryException $exception) {

        }
    }
}
