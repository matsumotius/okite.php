<?php
namespace Okite;
use Okite\Validator\Validation;
use Okite\Schema\Schema;

class Okite {

    private $schema;

    public function __construct($schema) {
        $this->schema     = new Schema($schema);
        $this->validation = new Validation($this->schema);
    }

    public function validate($query)
    {
        return $this->validation->execute($query);
    }
}
