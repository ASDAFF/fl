<?php

namespace WM\Forms;


/**
 * Class Form
 * @package WM\Forms
 */
class Form
{
    /**
     * @var array
     */
    protected $fields = array();
    /**
     * @var array
     */
    protected $rules = array();

    /**
     * @var array
     */
    protected $errors = array();

    /**
     * @return array
     */
    public function rules()
    {
        return $this->rules;
    }

    /**
     * @param array $rules
     * @return $this
     */
    public function setRules(array $rules = array())
    {
        $this->rules = $rules;
        return $this;
    }

    /**
     * @param array $fields
     * @param bool $clean
     * @return $this
     */
    public function setFields(array $fields = array(), $clean = true)
    {
        if($clean)
            $this->fields = $this->errors = array();

        foreach($fields as $name => $value)
            $this->fields[$name] = trim($value);
        return $this;
    }

    /**
     * @return array of attributes
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param $name
     * @return string|null
     */
    public function getField($name)
    {
        return isset($this->fields[$name]) ? $this->fields[$name] : null;
    }
    /**
     * @param $name
     * @return string|null
     */
    public function getFieldCP1251($name)
    {
        return isset($this->fields[$name]) ? iconv('UTF-8', 'Windows-1251', $this->fields[$name]) : null;
    }
    /**
     * @return bool
     */
    public function validate()
    {
        $existsValidators = $this->validators();
        foreach($this->rules() as $rule)
        {
            if(!isset($rule[0], $rule[1], $existsValidators[$rule[1]]))
                continue;

            $additionalParams = isset($rule[2]) && is_array($rule[2]) ? $rule[2] : array();

            $fields = preg_split('~\\s*+,\\s*+~u', $rule[0], -1, PREG_SPLIT_NO_EMPTY);

            foreach($fields as $field)
            {
                $value = isset($this->fields[$field]) ? $this->fields[$field] : null;
                $this->checkValue($field, new $existsValidators[$rule[1]]($field, $value, $additionalParams));
            }
        }

        return empty($this->errors);
    }

    /**
     * @param null $splitSym
     * @return array
     */
    public function getErrors($splitSym = null)
    {
        if(isset($splitSym))
        {
            $errors = array();
            foreach($this->errors as $name => $value)
            {
                $errors[$name] = is_array($value) ? join($splitSym, $value) : $value;
            }
            return $errors;
        }
        return $this->errors;
    }
    /**
     * @param null $splitSym
     * @return array
     */
    public function getErrorsCP1251($splitSym = null)
    {
        $errors = array();
        if(isset($splitSym))
        {
            foreach($this->errors as $name => $value)
                $errors[$name] = iconv('UTF-8', 'Windows-1251//IGNORE', (is_array($value) ? join($splitSym, $value) : $value));
        }
        else
        {
            foreach($this->errors as $name => $value)
                $errors[$name] = iconv('UTF-8', 'Windows-1251//IGNORE', $value);
        }

        return $errors;
    }

    /**
     * @param $name
     * @param Validators\Validator $validator
     * @return bool
     */
    protected function checkValue($name, Validators\Validator $validator)
    {
        if($validator->validate())
            return true;

        $this->setError($name, $validator->getError(), $validator->showAllErrors());

        return false;
    }

    /**
     * @param $name
     * @param $error
     * @param bool $showAllErrors
     */
    protected function setError($name, $error, $showAllErrors = false)
    {
        if(isset($this->errors[$name]))
        {
            if(!$showAllErrors)
                return ;
            if(is_array($this->errors[$name]))
                $this->errors[$name][] = $error;
            else
                $this->errors[$name] = array($this->errors[$name], $error);
        }
        else
            $this->errors[$name] = $error;
    }

    /**
     * @TODO Make all validators
     * @return array
     */
    public function validators()
    {
        return array(
            'boolean' => '\\WM\\Forms\\Validators\\BooleanValidator',
            //'captcha' => '\\WM\\Forms\\Validators\\CaptchaValidator',
            'recaptcha' => '\\WM\\Forms\\Validators\\RecaptchaValidator',
            'email' => '\\WM\\Forms\\Validators\\EmailValidator',
            //'date' => '\\WM\\Forms\\Validators\\DateValidator',
            'ip' => '\\WM\\Forms\\Validators\\IpValidator',
            'length' => '\\WM\\Forms\\Validators\\LengthValidator',
            'numerical' => '\\WM\\Forms\\Validators\\NumericValidator',
            'phone' => '\\WM\\Forms\\Validators\\PhoneValidator',
            'required' => '\\WM\\Forms\\Validators\\EmptyValidator',
            //'type' => '\\WM\\Forms\\Validators\\TypeValidator',
            'url' => '\\WM\\Forms\\Validators\\UrlValidator',
        );
    }
}