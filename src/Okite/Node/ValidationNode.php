<?php

namespace Okite\Node;

class ValidationNode
{
    public $validKeys   = array();
    public $invalidKeys = array();
    public $errors      = array();

    public function success($key)
    {
        if (false === is_string($key)) return;
        array_push($this->validKeys, $key);
    }

    public function error($key, $message = 'Unknown')
    {
        if (false === is_string($key)) return;
        array_push($this->invalidKeys, $key);
        $this->errors[$key] = $message;
    }

    public function isValid()
    {
        return 0 == count($this->invalidKeys);
    }

    public function getMessage()
    {
        $message = '';
        foreach ($this->errors as $key => $error) {
            $message .= sprintf('%s : %s', $key, $error);
        }
        return $message;
    }
}
