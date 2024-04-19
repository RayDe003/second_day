<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class ImageFileValidator extends AbstractValidator
{
    protected string $message = 'Файл :field должен быть изображением';

    public function rule(): bool
    {
        return isset($this->value['tmp_name']) && getimagesize($this->value['tmp_name']) !== false;
    }
}
