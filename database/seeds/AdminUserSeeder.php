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
                    "name" => "Franc Auxach Cortés",
                    "email" => "frankky96@gmail.com",
                    "password" => bcrypt(env('FRANC_PWD', '123456'))]
            );
        } catch (\Illuminate\Database\QueryException $exception) {

        }
    }
}
