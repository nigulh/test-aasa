<?php

require_once __DIR__ . "/ConstraintValidatorInterface.php";

abstract class ConstraintValidator implements ConstraintValidatorInterface
{
    /**
     * @var ValidationContext
     */
    protected $context;

    /**
     * {@inheritdoc}
     */
    public function initialize(ValidationContext $context)
    {
        $this->context = $context;
    }
}
