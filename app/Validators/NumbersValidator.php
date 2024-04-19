<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class NumbersValidator extends AbstractValidator
{
    protected string $message = 'Field :field только цифры';

    public function rule(): bool
    {
        $pattern = '/^[0-9]+$/iu';
        if (preg_match($pattern, $this->value) || $this->value === '') return true;
        else return false;
    }

}
