<?php namespace App\Models;

class Contract
{
    /**
     * @var String
     */
    public $name;

    /**
     * @var Integer
     */
    public $identityCode;

    /**
     * @var Float
     */
    public $amountInCurrency;

    /**
     * @var Integer
     */
    public $durationInMonths;

    /**
     * @var String
     */
    public $purposeCommentary;
}