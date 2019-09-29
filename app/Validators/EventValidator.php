<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class EventValidator.
 *
 * @package namespace App\Validators;
 */
class EventValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'user_id'           => 'required',
            'title'             => 'required|string|max:255',
            'description'       => 'required|string|max:255',
            'start_date'        => 'required|date_format:Y-m-d',
            'end_date'          => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'start_time'        => 'required|date_format:H:i',
            'end_time'          => 'required|date_format:H:i',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'title'             => 'required|string|max:255',
            'description'       => 'required|string|max:255',
            'start_date'        => 'required|date_format:Y-m-d',
            'end_date'          => 'required|date_format:Y-m-d|after_or_equal:start_date',
            'start_time'        => 'required|date_format:H:i',
            'end_time'          => 'required|date_format:H:i',
        ],
    ];
}
