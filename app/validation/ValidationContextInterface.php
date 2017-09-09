<?php

interface ValidationContextInterface
{
    /**
     * @param String $message
     */
    public function AddViolation(String $message);
}