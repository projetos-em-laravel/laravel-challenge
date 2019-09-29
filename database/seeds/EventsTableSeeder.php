<?php

use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        Event::create([
            'title'         =>  $faker->catchPhrase ,
            'description'   =>  $faker->sentence,
            'start_date'    =>  Carbon::today(),
            'start_time'    =>  '12:00',
            'end_date'      =>  Carbon::today(),
            'end_time'      =>  '12:00',
            'user_id'       =>  User::first()->id,
        ]);
        for($i=0; $i < 15 ; $i++ ){
            Event::create([
                'title'         =>  $faker->catchPhrase ,
                'description'   =>  $faker->sentence,
                'start_date'    =>  Carbon::today()->addDay($i),
                'start_time'    =>  '12:00',
                'end_date'      =>  Carbon::today()->addDay($i),
                'end_time'      =>  '12:00',
                'user_id'       =>  User::first()->id,
            ]);
            
            Event::create([
                'title'         =>  $faker->catchPhrase ,
                'description'   =>  $faker->sentence,
                'start_date'    =>  Carbon::today()->addDay($i),
                'start_time'    =>  '12:00',
                'end_date'      =>  Carbon::today()->addDay($i),
                'end_time'      =>  '12:00',
                'user_id'       =>  User::inRandomOrder()->first()->id,
            ]);
        }    

        
    }
}
