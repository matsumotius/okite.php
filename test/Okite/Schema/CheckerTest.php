<?php

use Okite\Schema\Checker;

class CheckerTest extends \PHPUnit_Framework_TestCase
{
    public $options = array(
        'type'     => 'string',
        'min'      => null,
        'max'      => null,
        'length'   => null,
        'default'  => null,
        'xss'      => false,
        'required' => false
    );

    public function testDefaultSchema()
    {
        $checker = new Checker();
        $schema  = $this->options;
        $body    = array('key' => $schema);
        $this->assertEquals(true, $checker->check($body));
    }

    public function testNumSpecifiedSchema()
    {
        $checker       = new Checker();
        $schema        = $this->options;
        $schema['min'] = 0;
        $schema['max'] = 999;
        $body          = array('key' => $schema);
        $this->assertEquals(true, $checker->check($body));
    }

    public function testLengthSpecifiedSchema()
    {
        $checker          = new Checker();
        $schema           = $this->options;
        $schema['length'] = 100;
        $body             = array('key' => $schema);
        $this->assertEquals(true, $checker->check($body));
    }

    public function testIllegalTypeSchema()
    {
        $this->setExpectedException('Okite\Exception\SchemaException');
        $checker        = new Checker();
        $schema         = $this->options;
        $schema['type'] = 'foobar'; // not such type
        $body           = array('key' => $schema);
        $checker->check($body);
    }

    public function testIllegalXssSchema()
    {
        $this->setExpectedException('Okite\Exception\SchemaException');
        $checker       = new Checker();
        $schema        = $this->options;
        $schema['xss'] = 100; // not true or false
        $body          = array('key' => $schema);
        $checker->check($body);
    }

    public function testIllegalNumSchema()
    {
        $this->setExpectedException('Okite\Exception\SchemaException');
        $checker       = new Checker();
        $schema        = $this->options;
        $schema['min'] = 999;
        $schema['max'] = 1; // max < min
        $body          = array('key' => $schema);
        $checker->check($body);
    }

    public function testIllegalLengthSchema()
    {
        $this->setExpectedException('Okite\Exception\SchemaException');
        $checker          = new Checker();
        $schema           = $this->options;
        $schema['length'] = 'foobar'; // not numeric
        $body             = array('key' => $schema);
        $checker->check($body);
    }

    public function testIllegalRequiredSchema()
    {
        $this->setExpectedException('Okite\Exception\SchemaException');
        $checker            = new Checker();
        $schema             = $this->options;
        $schema['required'] = 100; // not true or false
        $body               = array('key' => $schema);
        $checker->check($body);
    }
}
