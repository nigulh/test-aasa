<?php namespace App\Models;

use App\Validation\Constraints\NotEmpty;
use App\Validation\Validator;
use App\Validation\Constraints\Range;
use App\Validation\Constraints\Regex;


class ContractValidator extends Validator
{
    protected function initialFieldConstraints()
    {
        $notEmpty = new NotEmpty();
        $digitsOnly = new Regex("/^[0-9]+$/");
        $nameConstraint = new Regex("/^(([\x{00c0}-\x{01ff}a-zA-Z'\-])+ )+([\x{00c0}-\x{01ff}a-zA-Z'\-])+$/u");
        $identityCodeConstraint = new Regex("/^\d{11}$/");
        $purposeCommentaryConstraint = new Regex("/\b((puhkus)|(auto)|(remont)|(koduelektroonika)|(rent)|(pulmad))\b/");
        $constraints = array(
            "name" => array($notEmpty, $nameConstraint),
            "identityCode" => array($notEmpty, $identityCodeConstraint),
            "amountInCurrency" => array($notEmpty, $digitsOnly, new Range(1000, 10000)),
            "durationInMonths" => array($notEmpty, $digitsOnly, new Range(6, 24)),
            "purposeCommentary" => array($notEmpty, $purposeCommentaryConstraint)
        );
        return $constraints;
    }

    public function validate($value)
    {
        if (!$value instanceof Contract) {
            throw new \TypeError(__NAMESPACE__ . '\Contract');
        }
        return parent::validate($value);
    }
}