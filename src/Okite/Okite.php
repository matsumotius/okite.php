<?php
namespace Okite;
use Okite\Validator\Validation;
use Okite\Schema\Schema;

class Okite {

    private $schema;

    public function __construct($schema) {
        $this->schema = new Schema($schema);
    }

    public function validate($query)
    {
        foreach ($query as $key => $value) {
            if (false == $this->schema->has($key)) continue;
            $schemaRow = $this->schema->get($key);
            $result    = $this->validateRow($value, $schemaRow);
            if (false == $result) return array('isValid' => false);
        }
        return array('isValid' => true);
    }

    public function validateRow($value, $schemaRow)
    {
        $validation = new Validation($schemaRow);
        return $validation->execute($value);
    }
}
