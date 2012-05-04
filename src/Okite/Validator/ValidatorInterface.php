<?php
namespace Okite\Validator;

interface ValidatorInterface
{
    public function validate($value);

    public function validateType($value);

    public function validateXss($value);

    public function validateMin($value);

    public function validateMax($value);

    public function validateLength($value);
}
