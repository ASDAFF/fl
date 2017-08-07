<?php

namespace WM\Forms\Validators;


/**
 * Class PhoneValidator
 * @package WM\Forms\Validators
 */
class PhoneValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Неверный формат телефона';

    /**
     * @return bool
     */
    public function validate()
    {
        return !($this->hasError = !preg_match(
            '~^\\s*?(?:(?:\\+?\\s*?7)|(?:\\s*?8\\s*?))?(?:\\s*?-?\\s*?)?(?:\\(\\d{3}\\)|\\d{3})(?:\\s*?-?\\s*?)?\\d{3}(?:\\s*?-?\\s*?)?\\d{2}(?:\\s*?-?\\s*?)?\\d{2}$~',
            $this->checkValue
        ));
    }
}