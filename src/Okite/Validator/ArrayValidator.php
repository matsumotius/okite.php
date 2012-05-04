<?php
namespace Okite\Validator;
use Okite\Exception\ValidatorException;

class ArrayValidator extends Validator implements ValidatorInterface
{
    public function validateType($value)
    {
        return is_array($value);
    }

    public function validateMin($value)
    {
        if ($this->canSkip('min')) return true;
        return $this->schemaRow['min'] <= count($value);
    }

    public function validateMax($value)
    {
        if ($this->canSkip('max')) return true;
        return $this->schemaRow['max'] >= count($value);
    }

    public function validateLength($value)
    {
        if ($this->canSkip('length')) return true;
        return $this->schemaRow['length'] === count($value);
    }
}
