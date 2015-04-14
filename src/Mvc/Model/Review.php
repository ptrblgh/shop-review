<?php

namespace Shopreview\Mvc\Model;

/**
 * Review entity
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class Review
{
    public $id;
    public $review_body;
    public $review_rating;
    public $review_edit_date;
    public $review_add_date;
    public $username;

    /**
     * Retriving entity properties
     * 
     * @return array
     */
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }
}
