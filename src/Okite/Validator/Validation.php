<?php
namespace Okite\Validator;

use Okite\Exception\ValidatorException;
use Okite\Node\ValidationNode;

class Validation {

    public $schema;
    public $result;
    public function __construct($schema)
    {
        $this->schema = $schema;
        $this->result = new ValidationNode();
    }

    public function execute($query)
    {
        foreach ($query as $key => $value) {
            if (false == $this->schema->has($key)) continue;
            $schemaRow = $this->schema->get($key);
            try {
                $this->executeRow($value, $schemaRow);
                $this->result->success($key);
            } catch(ValidatorException $e) {
                $message = $e->getMessage();
                $this->result->error($key, $message);
            }
        }
        return $this->result;
    }

    private function executeRow($value, $schemaRow)
    {
        $prefix          = 'Okite\\Validator\\';
        $validatorClass  = $prefix. ucwords($schemaRow['type']). 'Validator';
        $validator       = new $validatorClass($schemaRow);
        $validator->validate($value);
    }
}
