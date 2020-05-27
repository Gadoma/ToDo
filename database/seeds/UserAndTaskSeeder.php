<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class UserAndTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\User::class, 2)->create()->each(function ($user) {
            
            //set API key
            $user->api_token = hash('sha256', str_pad('', 10, (string) $user->id));
            $user->save();
                        
            // Add 3 completed tasks
            $tasksCompleted = factory(App\Models\Task::class, 3)->make([
                'completed_at' => Carbon::yesterday(),
                'user_id' => $user->id,
            ]);
            $user->tasks()->saveMany($tasksCompleted);

            // Add 2 tasks for today
            $tasksToday = factory(App\Models\Task::class, 2)->make([
                'planned_at' => Carbon::today(),
                'user_id' => $user->id,
            ]);
            $user->tasks()->saveMany($tasksToday);


            // Add 2 tasks for tomorrow
            $tasksTomorrow = factory(App\Models\Task::class, 2)->make([
                'planned_at' => Carbon::tomorrow(),
                'user_id' => $user->id,
            ]);
            $user->tasks()->saveMany($tasksTomorrow);


            // Add 2 tasks without a plan
            $tasks = factory(App\Models\Task::class, 3)->make([
                'user_id' => $user->id,
            ]);
            $user->tasks()->saveMany($tasks);
        });
    }
}
