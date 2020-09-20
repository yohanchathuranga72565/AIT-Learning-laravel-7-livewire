<?php

use App\Grade;
use Illuminate\Database\Seeder;

class AddGradeList extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = ['Grade 1','Grade 2','Grade 3','Grade 4','Grade 5','Grade 6','Grade 7','Grade 8','Grade 9','Grade 10','Grade 11(O/L)','Grade 12(A/L)','Grade 13(A/L)'];
        foreach($grades as $grade){
            Grade::create([
                'grade' => $grade
            ]);
        }
        
    }
}
