<?php

namespace Okite\Schema;

use Okite\Exception\SchemaException;

class Checker
{
    static $checkOrder = array(
        'checkType', 
        'checkXss', 
        'checkMin', 
        'checkMax', 
        'checkLength', 
        'checkRequired',
        'checkDefault'
    );

    private $schema;
    public function check($schema)
    {
        $this->schema = $schema;
        foreach ($schema as $key => $row) {
            $this->checkRow($row);
        }
        return true;
    }

    private function checkRow($row)
    {
        foreach (self::$checkOrder as $checkMethod) {
            $this->$checkMethod($row);
        }
    }

    private function checkType($row)
    {
        $validType = in_array($row['type'], array_keys(Schema::$types));
        if (false === $validType) {
            throw new SchemaException();
        }
    }

    private function checkXss($row)
    {
        if ($this->isTrueOrFalse($row['xss'])) return;
        throw new SchemaException();
    }

    private function checkMin($row)
    {
        if (null === $row['min']) return true;

        if (false === $this->isValidOption('range', $row)) {
            throw new SchemaException();
        }
        if (false === is_numeric($row['min'])) {
            throw new SchemaException();
        }
    }

    private function checkMax($row)
    {
        if (null === $row['max']) return true;

        if (false === $this->isValidOption('range', $row)) {
            throw new SchemaException();
        }
        if (false === is_numeric($row['max'])) {
            throw new SchemaException();
        }
        if ($row['min'] !== null && $row['max'] < $row['min']) {
            throw new SchemaException();
        }
    }

    private function checkLength($row)
    {
        if (null === $row['length']) return true;

        if (false === is_numeric($row['length'])) {
            throw new SchemaException();
        }
        if (false === $this->isValidOption('length', $row)) {
            throw new SchemaException();
        }
    }

    private function checkRequired($row)
    {
        if ($this->isTrueOrFalse($row['required'])) return true;
        throw new SchemaException();
    }

    private function checkDefault($row)
    {
        // todo: validate value by type
        return true;
    }

    private function isTrueOrFalse($value)
    {
        return (true === $value || false === $value);
    }

    private function isValidOption($optionKey, $row)
    {
        $type = Schema::$types[$row['type']];
        return $type[$optionKey];
    }
}
