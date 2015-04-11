<?php

namespace Shopreview\Validator;

interface ValidatorInterface
{
    /**
     * Checks $data agains a validation rule(s)
     *
     * @param $data
     * @return boolean
     */
    public function isValid($data);
}
