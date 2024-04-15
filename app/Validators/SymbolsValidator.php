<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class SymbolsValidator extends AbstractValidator
{
    protected string $message = 'Field :field только символы';

    public function rule(): bool
    {
        $pattern = '/^[а-яё]+$/iu';
        if (preg_match($pattern, $this->value)) return true;
        else return false;
    }

}
