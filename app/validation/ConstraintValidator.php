<?php namespace App\Validation;

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
