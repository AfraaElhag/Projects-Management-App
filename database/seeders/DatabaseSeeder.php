<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\Task;
use App\Models\ProjectStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         
        /* $users=User::factory()->count(30)->state(new Sequence(
            ['role' => 'designer'],
            ['role' => 'customer care'],
            ['role' => 'architect'],
           
        ))->create();*/

         Client::factory(50)->create();

        $tasks= Task::factory()->count(30)->state(new Sequence(
            ['milestone_number' => 1],
            ['milestone_number' => 2],
            ['milestone_number' => 3],
            ['milestone_number' => 4],
           
        ))->state(new Sequence(
            ['responsible' => 'senior designer'],
            ['responsible' => 'junior designer'],
            ['responsible' => 'customer care'], 
            ['responsible' => 'accountant'],
            ['responsible' => 'admin'],
            ['responsible' => 'department manager'],
            ['responsible' => 'project manager'], 
            ['responsible' => 'director'],  
        ))->create();

         $projects=Project::factory(20)->has( ProjectStatus::factory()
                    ->count(4)
                    ->state(new Sequence(
                        ['milestone' => 1],
                        ['milestone' => 2],
                        ['milestone' => 3],
                        ['milestone' => 4],
                       
                    ))
        ) 
        /*->has(User::factory()->count(3)->state(new Sequence(
            ['role' => 'designer'],
            ['role' => 'customer care'],
            ['role' => 'architect'],
           
        )))*/
       /* has(User::factory()->count(3)->state(new Sequence(
            ['role' => 'designer'],
            ['role' => 'customer care'],
            ['role' => 'architect'],
           
        )))*/
        ->hasAttached($tasks,['status' => 'not completed']
              
       
        )
        ->create();
         

         $users=User::factory()->count(30)->state(new Sequence(
            ['role' => 'senior designer'],
            ['role' => 'junior designer'],
            ['role' => 'customer care'], 
            ['role' => 'accountant'],
            ['role' => 'admin'],
            ['role' => 'department manager'],
            ['role' => 'project manager'], 
            ['role' => 'director'], 
           
        ))->hasprojects(3)
        ->create();
        

        /* ProjectStatus::factory(20)->for($projects)->state(new Sequence(
            ['milestone' => 1],
            ['milestone' => 2],
            ['milestone' => 3],
            ['milestone' => 4],
           
        ))->create();*/
       
         /*
         Task::factory()->count(4)->state(new Sequence(
            ['milestone_number' => 1],
            ['milestone_number' => 2],
            ['milestone_number' => 3],
            ['milestone_number' => 4],
           
        ))->state(new Sequence(
            ['responsible' => 'designer'],
            ['responsible' => 'customer care'],
            ['responsible' => 'architect'],
            ['responsible' => 'accountant'],
            ['responsible' => 'admin'],
            ['responsible' => 'office manager'],
            ['responsible' => 'project manager'],     
        )*/
    }
}
