<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CountryCodeRule implements Rule
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
		try {
			\Countries::getOne($value, "en");
			return true;
		}
		catch (\Monarobase\CountryList\CountryNotFoundException $e)
		{
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
        return 'The country specified is invalid.';
    }
}
