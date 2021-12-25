<?php

use App\User;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::find(1)
            ->update([
                'avatar' => '/images/avatar-1.jpeg'
            ]);
    }
}
