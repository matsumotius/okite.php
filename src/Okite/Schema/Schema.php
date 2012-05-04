<?php

namespace Okite\Schema;

class Schema
{
    static $options = array(
        'type'     => 'string',
        'min'      => null,
        'max'      => null,
        'length'   => null,
        'default'  => null,
        'xss'      => false,
        'required' => false
    );
    static $types = array(
        'int'    => array('range' => true, 'length' => false),
        'string' => array('range' => true, 'length' => true),
        'array'  => array('range' => true, 'length' => true)
    );

    public  $schema;
    private $parser;
    private $checker;
    private $body;
    public function __construct($schema)
    {
        $this->schema  = $schema;
        $this->parser  = new Parser();
        $this->checker = new Checker();

        $this->body    = $this->parser->parse($schema);
        $this->checker->check($this->body);
    }

    public function get($key = null)
    {
        if (null === $key) {
            return $this->body;
        } else {
            return $this->body[$key];
        }
    }

    public function getKeys()
    {
        return array_keys($this->body);
    }

    public function has($key = null)
    {
        if (null === $key) return false;
        return in_array($key, array_keys($this->body));
    }

    static function isDefaultValue($value, $key)
    {
        return self::$options[$key] == $value;
    }
}
