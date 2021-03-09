<?php

namespace App\Rules;

use ZipArchive;
use Illuminate\Contracts\Validation\Rule;

class validGameZip implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $zip = new ZipArchive;
        $res = $zip->open($value->path());
        for( $i = 0; $i < $zip->numFiles; $i++ ){ 
            $stat = $zip->statIndex( $i ); 
            if(basename( $stat['name'] ) == 'index.html'){
                return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Zip file must have an index.html in the base of the zip';
    }
}
