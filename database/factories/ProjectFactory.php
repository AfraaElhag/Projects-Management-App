<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'project_name' => $this->faker->word,
        'status' => $this->faker->word,
        'start_date' => $this->faker->date('Y-m-d H:i:s'),
        'end_date' => $this->faker->date('Y-m-d H:i:s'),
        'details' => $this->faker->text,
        'client_id' => Client::pluck('id')->random(),
        ];

 
        
    }
}
