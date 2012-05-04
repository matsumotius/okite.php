<?php

use Okite\Okite;

class OkiteTest extends \PHPUnit_Framework_TestCase
{
    public function testIntOkite()
    {
        $schema = array(
            'point' => array(
                'type' => 'int',
                'min'  => 1,
                'max'  => 999
            )
        );
        $okite  = new Okite($schema);
        $result = $okite->validate(array('point' => 100));
        $this->assertEquals(true, $result['isValid']);
        $result = $okite->validate(array('point' => 1000));
        $this->assertEquals(false, $result['isValid']);
    }

    public function testStringOkite()
    {
        $schema = array(
            'name' => array(
                'type' => 'string',
                'min'  => 1,
                'max'  => 3
            )
        );
        $okite  = new Okite($schema);
        $result = $okite->validate(array('name' => '123'));
        $this->assertEquals(true, $result['isValid']);
        $result = $okite->validate(array('name' => '1234'));
        $this->assertEquals(false, $result['isValid']);
        $result = $okite->validate(array('name' => 123));
        $this->assertEquals(false, $result['isValid']);
    }


    public function testArrayOkite()
    {
        $schema = array(
            'item' => array(
                'type' => 'array',
                'min'  => 1,
                'max'  => 3
            )
        );
        $okite  = new Okite($schema);
        $result = $okite->validate(array('item' => array(1,2,3)));
        $this->assertEquals(true, $result['isValid']);
        $result = $okite->validate(array('item' => array(1,2,3,4)));
        $this->assertEquals(false, $result['isValid']);
        $result = $okite->validate(array('item' => '1,2,3,4'));
        $this->assertEquals(false, $result['isValid']);
    }
}
