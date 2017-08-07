<?php

namespace WM\Forms\Validators;


/**
 * Class LengthValidator
 * @package WM\Forms\Validators
 */
class LengthValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Поле {name} должно содержать от {min} до {max} символов';

    /**
     * @return bool
     */
    public function validate()
    {
        $this->checkValue = trim($this->checkValue);

        return !($this->hasError = (
            isset($this->additionalParams['min']) && mb_strlen($this->checkValue, 'UTF-8') < $this->additionalParams['min'] ||
            isset($this->additionalParams['max']) && mb_strlen($this->checkValue, 'UTF-8') > $this->additionalParams['max']
        ));
    }

    /**
     * @param string $value
     */
    public function setDataMin($value)
    {
        $this->additionalParams['min'] = $value;
    }
    /**
     * @param string $value
     */
    public function setDataMax($value)
    {
        $this->additionalParams['max'] = $value;
    }
}