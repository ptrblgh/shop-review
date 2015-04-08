<?php

namespace Shopreview\Mvc\Model;

class Review
{
    public $id;
    public $user_id;
    public $review_text;
    public $erview_rating;

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
