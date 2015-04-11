<?php

namespace Shopreview;

use Shopreview\Helper;

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
     */
    public function __construct(array $config)
    {
        $mail = new \PHPMailer();

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
     */
    public function setAddress($address)
    {
        $this->mail->addAddress(Helper::sanitizeInput($address));
    }

    /**
     * Setter for the message body
     * 
     * @param string $body
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
     * @param string $address
     */
    public function setSubject($subject)
    {
        $this->mail->Subject = Helper::sanitizeInput($subject);
    }
    /**
     * Send the message
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
