<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userCount = max((int) $this->command->ask('Ile userów wariacie?', 20),1);
        User::factory()->definedUser()->create();
        User::factory($userCount)->create();
    }
}
