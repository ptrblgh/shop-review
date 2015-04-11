<?php

namespace Shopreview\Mvc\Model;

class Review
{
    public $id;
    public $review_body;
    public $rerview_rating;
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
