<?php

namespace WM\Forms\Validators;


/**
 * Class EmptyValidator
 * @package WM\Forms\Validators
 */
class EmptyValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Введите {name}';

    /**
     * @return bool
     */
    public function validate()
    {
        return !($this->hasError = trim($this->checkValue) === '');
    }
}