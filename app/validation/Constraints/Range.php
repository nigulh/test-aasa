<?php namespace App\Validation\Constraints;
use App\Validation\Constraint;

class Range extends Constraint
{
    public $min;
    public $max;
    public $minMessage = 'This value should be %s or more.';
    public $maxMessage = 'This value should be %s or less.';
    public $invalidMessage = 'This value should be a valid number.';

    public function __construct($min, $max) {
        if ($min == null && $max == null) {
            throw new \InvalidArgumentException(sprintf('Either option "min" or "max" must be given to constraint %s', __CLASS__));
        }
        $this->min = $min;
        $this->max = $max;
    }
}