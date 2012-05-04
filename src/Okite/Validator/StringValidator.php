<?php
namespace Okite\Validator;

use Okite\Exception\ValidatorException;

class StringValidator extends Validator implements ValidatorInterface
{
    public function validateType($value)
    {
        return is_string($value);
    }

    public function validateMin($value)
    {
        if ($this->canSkip('min')) return true;
        return $this->schemaRow['min'] <= mb_strlen($value);
    }

    public function validateMax($value)
    {
        if ($this->canSkip('max')) return true;
        return $this->schemaRow['max'] >= mb_strlen($value);
    }

    public function validateLength($value)
    {
        if ($this->canSkip('length')) return true;
        return $this->schemaRow['length'] == mb_strlen($value);
    }
}
