<?php

use Okite\Schema\Parser;

class ParserTest extends \PHPUnit_Framework_TestCase
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
        $parser = new Parser();
        $schema = array('key' => $this->options);
        $this->assertEquals($schema, $parser->parse($schema));
    }

    public function testTypeOnlySpecifiedSchema()
    {
        $parser   = new Parser();
        $schema   = array('key' => array('type' => 'string'));
        $expected = array('key' => $this->options);
        $this->assertEquals($expected, $parser->parse($schema));
    }
}
