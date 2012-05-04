<?php

namespace Okite\Schema;

class Parser
{
    public $schema;
    public function parse($schema)
    {
        $this->schema = $schema;
        $res = array();
        foreach($this->schema as $key => $schemaRow) {
            $res[$key] = $this->parseRow($schemaRow);
        }
        return $res;
    }

    // todo: convert
    private function parseRow($schemaRow)
    {
        $res = Schema::$options;
        foreach ($schemaRow as $optionKey => $value) {
            $res[$optionKey] = $value;
        }
        return $res;
    }
}
