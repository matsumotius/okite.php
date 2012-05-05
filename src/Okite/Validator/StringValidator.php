<?php
namespace Okite\Validator;

use Okite\Exception\ValidatorException;

class StringValidator extends Validator implements ValidatorInterface
{
    public function validateType($value)
    {
        if (false === is_string($value)) {
            throw new ValidatorException('invalid type');
        }
        return true;
    }

    public function validateMin($value)
    {
        if ($this->canSkip('min')) return true;
        if ($this->schemaRow['min'] > mb_strlen($value)) {
            throw new ValidatorException('less than minimum length');
        }
        return true;
    }

    public function validateMax($value)
    {
        if ($this->canSkip('max')) return true;
        if ($this->schemaRow['max'] < mb_strlen($value)) {
            throw new ValidatorException('greater than maximum length');
        }
        return true;
    }

    public function validateLength($value)
    {
        if ($this->canSkip('length')) return true;
        if ($this->schemaRow['length'] != mb_strlen($value)) {
            throw new ValidatorException('invalid string length');
        }
        return true;
    }
}
