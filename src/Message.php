<?php

namespace Shopreview;

use Shopreview\Helper;

/**
 * A simple class for wrapping \PHPMailer
 * 
 * @author Péter Balogh <peter.balogh@theory9.hu>
 * @link https://github.com/ptrblgh/shop-review for source
 * @link http://shop-review.theory9.hu for demo
 */
class Message
{
    /**
     * PHPMailer object
     * 
     * @var \PHPMailer
     */
    protected $mail;

    /**
     * Constructor for message
     * 
     * @param array $config
     * @return void
     */
    public function __construct(array $config)
    {
        if (class_exists('PHPMailer')) {
             $mail = new \PHPMailer();
        } else {
            throw new \Exception("Failed to load PHPMailer. Class does not exist.");
        }

        $mail->isSMTP();
        $mail->Host = $config['host'];
        $mail->From = $config['from'];
        $mail->FromName = $config['from_name'];
        if (isset($config['port']))  {
            $mail->Port = $config['port'];
        }

        $this->mail = $mail;
    }

    /**
     * Setter for the message adressee's email
     * 
     * @param string $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->mail->addAddress(Helper::sanitizeInput($address));
    }

    /**
     * Setter for the message body
     * 
     * @param string $body
     * @return void
     */
    public function setBody($body)
    {
        $body = Helper::sanitizeInput($body);
        $this->mail->Body = $body;
        $this->mail->AltBody = $body;
    }

    /**
     * Setter for the message subject
     * 
     * @param string $subject
     * @return void
     */
    public function setSubject($subject)
    {
        $this->mail->Subject = Helper::sanitizeInput($subject);
    }

    /**
     * Send the message
     *
     * @return string|boolean
     */
    public function send()
    {
        if (!$this->mail->send()) {
            return $this->mail->ErrorInfo;
        } else {
            return true;
        }
    }
}
