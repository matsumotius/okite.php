<?php

use Okite\Schema\Schema;
use Okite\Validator\IntValidator;

class IntValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultOptions()
    {
        $schemaRow         = Schema::$options;
        $schemaRow['type'] = 'int';
        $validator         = new IntValidator($schemaRow);
        $this->assertEquals(true,  $validator->validate(100));
    }

    public function testIllegalType()
    {
        $this->setExpectedException('Okite\Exception\ValidatorException');
        $schemaRow         = Schema::$options;
        $schemaRow['type'] = 'int';
        $validator         = new IntValidator($schemaRow);
        $validator->validate('foo');
    }

    public function testNumSpecifiedOptions()
    {
        $schemaRow         = Schema::$options;
        $schemaRow['type'] = 'int';
        $schemaRow['min']  = 1;
        $schemaRow['max']  = 100;
        $validator         = new IntValidator($schemaRow);
        $this->assertEquals(true,  $validator->validate(100));
        $this->assertEquals(true,  $validator->validate(50));
    }

    public function testIllegalNum()
    {
        $this->setExpectedException('Okite\Exception\ValidatorException');
        $schemaRow         = Schema::$options;
        $schemaRow['type'] = 'int';
        $schemaRow['min']  = 1;
        $schemaRow['max']  = 100;
        $validator         = new IntValidator($schemaRow);
        $validator->validate(0);
        $validator->validate(1000);
    }
}
