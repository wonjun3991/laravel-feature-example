<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UserTypeRule implements Rule
{
    const USER_TYPE_ARRAY = ['멘토', '멘티'];

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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, self::USER_TYPE_ARRAY);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This :attribute must be "멘토" or "멘티".';
    }
}
