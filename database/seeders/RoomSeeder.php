<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $departments = Department::all();

        foreach($departments as $department) {
            // Setting Random number of Courses for each department
            $rooms = rand(35,45);
            for($i = 1; $i <= $rooms; $i++) {
                // Creating Random Courses for Each Department
                $room = new Room;
                $room->name = fake()->word();

                // The name must be 3 or 4 letters
                if(strlen($room->name) < 2 || strlen($room->name) > 4) {
                    // if not, start that step again
                    $i = $i-1;
                    continue;
                }else{
                    // $room->name = strtoupper($room->name).' '.rand(1, 35);
                    $room->slug = strtoupper($room->name).' '.rand(1, 35);
                }

                $room->department_id = $department->id;
                $room->floor = fake()->randomElement(['First','Second','Third','Fourth','Fifth','Sixth','Seventh','Eighth']);
                $room->type = "classroom"; //auditorium or lab or office
                $room->exams_cap = rand(100,150);
                $room->reg_cap = rand(250,400);
                $room->max_cap = rand(400,450);
                // $room->location = NULL;
                $room->save();
            }
        }
    }
}
