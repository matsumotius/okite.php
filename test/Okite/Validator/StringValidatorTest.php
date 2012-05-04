<?php

use Okite\Schema\Schema;
use Okite\Validator\StringValidator;

class StringValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultOptions()
    {
        $schemaRow         = Schema::$options;
        $validator         = new StringValidator($schemaRow);
        $this->assertEquals(true, $validator->validate('foo'));
        $this->assertEquals(false, $validator->validate(100));
    }

    public function testRangeSpecifiedOptions()
    {
        $schemaRow         = Schema::$options;
        $schemaRow['min']  = 3;
        $schemaRow['max']  = 10;
        $validator         = new StringValidator($schemaRow);
        $this->assertEquals(true,  $validator->validate('012'));
        $this->assertEquals(true,  $validator->validate('0123456789'));
        $this->assertEquals(false, $validator->validate('01'));
        $this->assertEquals(false, $validator->validate('0123456789a'));
    }

    public function testLengthSpecifiedOptions()
    {
        $schemaRow           = Schema::$options;
        $schemaRow['length'] = 3;
        $validator           = new StringValidator($schemaRow);
        $this->assertEquals(true,  $validator->validate('012'));
        $this->assertEquals(false, $validator->validate('0123456789a'));
    }
}
