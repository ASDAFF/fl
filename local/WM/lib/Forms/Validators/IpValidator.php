<?php

namespace WM\Forms\Validators;


/**
 * Class IpValidator
 * @package WM\Forms\Validators
 */
class IpValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Неверный формат IP-адреса';

    /**
     * @return bool
     */
    public function validate()
    {
        return !($this->hasError = !filter_var($this->checkValue, FILTER_VALIDATE_IP));
    }

}