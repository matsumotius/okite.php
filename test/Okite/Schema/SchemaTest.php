<?php

use Okite\Schema\Schema;

class SchemaTest extends \PHPUnit_Framework_TestCase
{
    public $schema;

    public function testDefaultSchema()
    {
        $foo = array(
             'type'     => 'string',
             'min'      => null,
             'max'      => null,
             'length'   => null,
             'default'  => null,
             'xss'      => false,
             'required' => false
        );
        $this->schema = new Schema(
            array(
                'foo' => $foo
            )
        );
        $schema_foo = $this->schema->get('foo');
        $this->assertEquals($foo['type'], $schema_foo['type']);
    }

    public function testMinimumSchema()
    {
        $foo = array();
        $this->schema = new Schema(
            array(
                'foo' => $foo
            )
        );
        $schema_foo = $this->schema->get('foo');
        $this->assertEquals('string', $schema_foo['type']);
    }

    public function testDifferentSchema()
    {
        $foo = array(
             'type'     => 'int',
             'min'      => 1,
             'max'      => 100,
             'length'   => null,
             'default'  => null,
             'xss'      => false,
             'required' => false
        );
        $this->schema = new Schema(
            array(
                'foo' => $foo
            )
        );
        $schema_foo = $this->schema->get('foo');
        $this->assertEquals($foo['type'], $schema_foo['type']);
        $this->assertEquals($foo['min'],  $schema_foo['min']);
        $this->assertEquals($foo['max'],  $schema_foo['max']);
    }
}
