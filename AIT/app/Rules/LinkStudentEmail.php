<?php

namespace App\Rules;

use App\Student;
use Illuminate\Contracts\Validation\Rule;

class LinkStudentEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $email;
    public $message;
    public function __construct($email)
    {
        $this->email = $email;
    }



    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $students = Student::all();
        foreach($students as $student){
            if($student->email == $this->email){
                if($student->parent__id == NULL){
                    return true;
                    break;
                }
                else{
                    $this->message = 'This email is already linked.';
                    return false;
                    break;
                }
                
            }
            else{
                
            }
        }
        $this->message = 'This email is not registered as a student.';
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
