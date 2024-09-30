<?php

namespace Database\Seeders;

use App\Models\Program;
use App\Models\ClassGroup;
use App\Models\ProgramStream;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // function getFirstLetters($text) {
        //     // Split the text into words
        //     $words = explode(' ', $text);
            
        //     // Extract the first letter of each word and concatenate them
        //     $firstLetters = '';
        //     foreach ($words as $word) {
        //         $firstLetters .= substr($word, 0, 1);
        //     }
            
        //     return substr($firstLetters,1);
        // }

        $streams = ProgramStream::all();

        $base_year = 2020;

        foreach($streams as $stream) {
            for($s=1; $s<=$stream->duration; $s++){
                
                $classgroup = new ClassGroup;

                // $classgroup->name = getFirstLetters($program->name);
                $classgroup->year = $s;
                $classgroup->program_stream_id = $stream->id;
                $classgroup->start_year = ($base_year + ($stream->duration - $s)) . "-01-01";
                $classgroup->end_year  = ($base_year + $stream->duration) . "-01-01";
                
                $classgroup->save();
            }
            
        }
    }
}
