<?php

namespace WM\Forms\Validators;


/**
 * Class UrlValidator
 * @package WM\Forms\Validators
 */
class UrlValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Неверный формат URL';

    /**
     * @return bool
     */
    public function validate()
    {
        return !($this->hasError = !filter_var($this->checkValue, FILTER_VALIDATE_URL));
    }
}