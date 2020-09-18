<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageValidationWithNull implements Rule
{
    /**
     * Create a new rule instance.
     * 
     * @return void
     */
    public $file;
    public $message;

    public function __construct($file)
    {
        $this->file = $file;
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
        $extension = strtolower(pathinfo($this->file, PATHINFO_EXTENSION));
        if($extension == 'jpeg' || $extension == 'jpg' || $extension == 'bmp' || $extension == 'gif' || $extension == 'svg' || $extension == 'webp' || $extension == null){
            return true;
        }
        else{
            $this->message = "Please add an image.";
            return false;
        }
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
