<?php

namespace WM\Forms\Validators;


/**
 * Class NumericValidator
 * @package WM\Forms\Validators
 */
class NumericValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Поле {name} должно быть числом';

    /**
     * @return bool
     */
    public function validate()
    {
        return !($this->hasError = !filter_var($this->checkValue, FILTER_VALIDATE_INT));
    }
}