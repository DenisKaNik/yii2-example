<?php

namespace library\validators;

use yii\validators\RegularExpressionValidator;

class SlugValidator extends RegularExpressionValidator
{
    public $pattern = '#^[a-z0-9_-]+$#';
    public $message = 'Only [a-z0-9_-] symbols are allowed.';
}
