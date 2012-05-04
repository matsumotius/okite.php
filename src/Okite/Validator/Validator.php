<?php
namespace Okite\Validator;

use Okite\Schema\Schema;

abstract class Validator
{
    public $schemaRow;
    public function __construct($schemaRow)
    {
        $this->schemaRow = $schemaRow;
    }

    public function canSkip($key = null)
    {
        if (null == $key || $key == 'type') return false;
        return Schema::isDefaultValue($this->schemaRow[$key], $key);
    }

    public $validateOrder = array(
        'validateType', 
        'validateXss', 
        'validateMin', 
        'validateMax', 
        'validateLength'
    );
    public function validate($value)
    {
        // todo: make specific report and return.
        foreach ($this->validateOrder as $validateMethod)
        {
            if ($this->$validateMethod($value)) continue;
            return false;
        }
        return true;
    }

    public function validateType($value)
    {
        return true;
    }

    public function validateXss($value)
    {
        return true;
    }

    public function validateMin($value)
    {
        return true;
    }

    public function validateMax($value)
    {
        return true;
    }

    public function validateLength($value)
    {
        return true;
    }
}

