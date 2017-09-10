<?php namespace App\Validation\Constraints;
use App\Validation\Constraint;

class Regex extends Constraint
{
    public $pattern;
    public $message = 'This value is invalid.';

    public function __construct($pattern) {
        if ($pattern == null) {
            throw new \InvalidArgumentException(sprintf('Parameter "pattern" must be given to constraint %s', __CLASS__));
        }
        $this->pattern = $pattern;
    }
}