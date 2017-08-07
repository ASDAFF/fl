<?php

namespace WM\Forms\Validators;


/**
 * Class RecaptchaValidator
 * @package WM\Forms\Validators
 */
class RecaptchaValidator extends Validator
{
    /**
     *
     */
    const DEFAULT_MESSAGE = 'Неверный проверочный код';

    /**
     * @return bool
     */
    public function validate()
    {
        if(empty($this->checkValue))
            return !($this->hasError = true);

        $reCaptcha = \WM\Forms\ReCaptcha::get($this->additionalParams['sitekey']);
        $response = $reCaptcha->verifyResponse(
            $_SERVER['REMOTE_ADDR'],
            $this->checkValue
        );

        return !($this->hasError = (!$response || !$response->success));
    }
    /**
     * @param string $value
     */
    public function setDataSitekey($value)
    {
        $this->additionalParams['sitekey'] = $value;
    }
}