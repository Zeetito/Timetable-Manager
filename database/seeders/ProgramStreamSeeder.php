<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\ProgramStream;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramStreamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $ug_programs = [
            1, 2, 3, 4, 50, 51, 52, 53, 70, 71, 72, 73, 74, 75, 76, 
            106, 107, 108, 109, 110, 111, 112, 113, 140, 172, 173, 174, 
            175, 176, 177, 178, 213, 214, 215, 216, 217, 224, 225, 226, 
            227, 228, 229, 230, 231, 232, 233, 234, 235, 257, 258, 259, 
            278, 279, 280, 281, 282, 283, 284, 285, 286, 287, 295, 296, 
            297, 319, 320, 336, 337, 338, 339, 340, 341, 342, 343, 344, 
            345, 346, 347, 348, 349, 383, 384, 385, 386, 387, 388, 389, 
            390, 391, 392, 393, 394, 395, 396, 397, 435, 436, 437, 438, 
            439, 440, 441
        ];
        // There should be at least 3 streams for all programs
        foreach(Program::all() as $program){

            for($i=1; $i <= 3; $i++){
                
                $stream = new ProgramStream;
                $stream->program_id = $program->id;
                $stream->type = $i == 1? 'regular' : ($i == 2 ? 'idl' : 'something');
                $stream->duration = rand(3,6);
                $stream->graduate =  in_array($program->id, $ug_programs) ? 'ug' : 'pg' ; 
                $stream->save();

            }
            
        }
    }
}
