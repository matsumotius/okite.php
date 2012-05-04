<?php

use Okite\Schema\Schema;
use Okite\Validator\ArrayValidator;

class ArrayValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultOptions()
    {
        $schemaRow         = Schema::$options;
        $schemaRow['type'] = 'array';
        $validator         = new ArrayValidator($schemaRow);
        $this->assertEquals(true,  $validator->validate(array(1,2,3)));
        $this->assertEquals(false, $validator->validate('foo'));
        $this->assertEquals(false, $validator->validate(10000));
    }

    public function testRangeSpecifiedOptions()
    {
        $schemaRow         = Schema::$options;
        $schemaRow['type'] = 'array';
        $schemaRow['min']  = 1;
        $schemaRow['max']  = 3;
        $validator         = new ArrayValidator($schemaRow);
        $this->assertEquals(true,  $validator->validate(array(1)));
        $this->assertEquals(true,  $validator->validate(array(1,2,3)));
        $this->assertEquals(false, $validator->validate(array()));
        $this->assertEquals(false, $validator->validate(array(1,2,3,4,5)));
    }

    public function testLengthSpecifiedOptions()
    {
        $schemaRow           = Schema::$options;
        $schemaRow['type']   = 'array';
        $schemaRow['length'] = 3;
        $validator           = new ArrayValidator($schemaRow);
        $this->assertEquals(true,  $validator->validate(array(1,2,3)));
        $this->assertEquals(false, $validator->validate(array(1,2)));
        $this->assertEquals(false, $validator->validate(array(1,2,3,4,5)));
    }
}
