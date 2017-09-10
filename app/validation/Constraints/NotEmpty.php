<?php namespace App\Validation\Constraints;

use App\Validation\Constraint;

class NotEmpty extends Constraint
{
    public $message = 'This value is missing.';

    public function __construct()
    {
    }
}