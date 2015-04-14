<?php

namespace Shopreview\Validator;

/**
 * Interface for validators
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
interface ValidatorInterface
{
    /**
     * Checks $data agains a validation rule
     *
     * @param string|array $data
     * @return boolean
     */
    public function isValid($data);
}
