<?php namespace App\Validation;

class ValidationContext implements ValidationContextInterface
{
    /**
     * @var String
     */
    protected $currentFieldName;
    /**
     * @var array
     */
    protected $fieldViolations;

    public function __construct()
    {
        $this->fieldViolations = array();
    }

    /**
     * @param String $currentFieldName
     */
    public function SetCurrentFieldName(String $currentFieldName)
    {
        $this->currentFieldName = $currentFieldName;
    }

    /**
     * @param String $message
     */
    public function AddViolation(String $message)
    {
        if (!array_key_exists($this->currentFieldName, $this->fieldViolations)) {
            $this->fieldViolations[$this->currentFieldName] = array();
        }
        $this->fieldViolations[$this->currentFieldName][] = $message;
    }

    public function GetFieldViolations()
    {
        return $this->fieldViolations;
    }

    public function GetViolations()
    {
        if (array_key_exists(null, $this->fieldViolations)) {
            return $this->fieldViolations[null];
        }
        return array();
    }
}