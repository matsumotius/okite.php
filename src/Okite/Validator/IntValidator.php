<?php
namespace Okite\Validator;

use Okite\Exception\ValidatorException;

class IntValidator extends Validator implements ValidatorInterface
{
    public function validateType($value)
    {
        if (false == is_int($value)) {
            throw new ValidatorException('invalid type');
        }
        return true;
    }

    public function validateMin($value)
    {
        if ($this->canSkip('min')) return true;
        if ($this->schemaRow['min'] > $value) {
            throw new ValidatorException('less than minimum value');
        }
        return true;
    }

    public function validateMax($value)
    {
        if ($this->canSkip('max')) return true;
        if ($this->schemaRow['max'] < $value) {
            throw new ValidatorException('greater than maximum value');
        }
        return true;
    }
}
