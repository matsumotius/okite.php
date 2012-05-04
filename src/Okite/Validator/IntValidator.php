<?php
namespace Okite\Validator;

use Okite\Exception\ValidatorException;

class IntValidator extends Validator implements ValidatorInterface
{
    public function validateType($value)
    {
        return is_int($value);
    }

    public function validateMin($value)
    {
        if ($this->canSkip('min')) return true;
        return $this->schemaRow['min'] <= $value;
    }

    public function validateMax($value)
    {
        if ($this->canSkip('max')) return true;
        return $this->schemaRow['max'] >= $value;
    }
}
