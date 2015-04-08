<?php

namespace Shopreview\Validator;

interface ValidatorInterface
{
    /**
     * Checks agains a validation rule 
     *
     * @return boolean
     */
    public function isValid();
}
