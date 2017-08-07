<?php

namespace WM\Forms\Validators;


/**
 * Class BooleanValidator
 * @package WM\Forms\Validators
 */
class BooleanValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Поле {name} должно быть булевым';

    /**
     * @return bool
     */
    public function validate()
    {
        return !($this->hasError = !filter_var($this->checkValue, FILTER_VALIDATE_BOOLEAN));
    }

}