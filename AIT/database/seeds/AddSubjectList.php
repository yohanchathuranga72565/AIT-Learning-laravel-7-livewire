<?php

use App\Subject;
use Illuminate\Database\Seeder;

class AddSubjectList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = ['Science','Mathematics','ICT','Sinhala','English','Physics','Art'];
        foreach($subjects as $subject){
            Subject::create([
                'name' => $subject
            ]);
        }
    }
}
