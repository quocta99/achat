<?php

use App\Facade\Chat;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conversations')->truncate();
        DB::table('participants')->truncate();
        DB::table('messages')->truncate();
        DB::table('readed_messages')->truncate();

        User::find(1)
            ->update([
                'avatar' => '/images/avatar-1.jpeg'
            ]);

        $faker = \Faker\Factory::create();

        for ($i=0; $i < 100; $i++) { 
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => bcrypt('password')
            ]);
        }

        Auth::loginUsingId(1);

        $users = User::orderByRaw("RAND()")
            ->where('id', '!=', auth()->id())
            ->limit(100)
            ->get();

        foreach ($users as $key => $value) {
            $conversation = Chat::createConversation($value->id)
                ->getConversation();

            $ps = Chat::conversation($conversation)->getParticipants();
        
            $user = (bool)rand(0,1) ? $ps[1] : $ps[0];

            for ($i=0; $i < $faker->numberBetween(500, 1500); $i++) { 
                Chat::conversation($conversation)
                    ->getConversation()
                    ->messages()
                    ->create([
                        'sender_id' => $user->user_id,
                        'participant_id' => $user->id,
                        'message_type' => 'text',
                        'message' => $faker->text($faker->numberBetween(20, 150))
                    ]);
            }
        }
    }
}
