<?php

namespace Shopreview\Validator\FormValidator;

use Shopreview\Session;
use Shopreview\Mvc\Model\ReviewDbRepository;
use Shopreview\Validator\FormValidator\AbstractFormValidator;
use Shopreview\Validator;

class ReviewFormValidator extends AbstractFormValidator
{
    /**
     * Review database repository
     * 
     * @var object
     */
    protected $reviewRepository;

    /**
     * Constructor for class
     * 
     * @param UserDbRepository $userRepository
     */
    public function __construct(ReviewDbRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    /**
     * {inheritdoc}
     */
    public function isValid($elements = array())
    {
        if (!is_array($elements) || empty($elements)) {
            
            return false;
        }

        foreach ($elements as $key => $val) {
            switch ($key) {
                case 'review_review_body':
                    $validator = new Validator\EmptyValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] = "Review can't be empty.";
                    }

                    $options = array(
                        'min' => 5,
                        'max' => 21843,
                    );
                    $validator = new Validator\LengthValidator($options);
                    if (!$validator->isValid($val)) {
                        $this->errors[] 
                            = 'Review needs to be between 5 and 21843 characters.';
                    }
                    break;

                case 'review_review_rating':
                    $validator = new Validator\EmptyValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] = "Rating can't be empty.";
                    }

                    $validator = new Validator\DigitRangeValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] 
                            = 'Rating needs to be an integer between 1 and 5.';
                    }
                    break;

                case 'review_csrf_token':
                    $validator = new Validator\CsrfValidator();
                    if (!$validator->isValid($val)) {
                        $this->errors[] =  $validator->getOption('message');
                    }
                    break;

               case 'review_name':
                    $validator = new Validator\EmptyValidator();
                    if ($validator->isValid($val)) {
                        $this->errors[] = "Bots are not allowed.";
                    }
                    break;
                
                default:
                    break;
            }
        }
        
        return (empty($this->errors) ? true : false);
    }
}
