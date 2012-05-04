<?php
namespace Okite\Validator;

class Validation {

    public $validator;
    public function __construct($schemaRow)
    {
        $prefix          = 'Okite\\Validator\\';
        $validatorClass  = $prefix. ucwords($schemaRow['type']). 'Validator';
        $this->validator = new $validatorClass($schemaRow);
    }

    public function execute($value)
    {
        return $this->validator->validate($value);
    }
}
