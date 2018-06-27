<?php
/**
 * Created by Sabri Hamda.
 * Date: 22.06.18
 * Time: 21:04
 */

namespace src\Validator\Constraints;

/**
 * Class IsEmail
 * @package src\Controllers\Dashboard\Articles\Validator\Constraints
 */
class IsEmail
{
    /**
     * @var
     */
    private $message;

    /**
     * @param $item
     * @param $key
     * @return string|void
     */
    private function arrayIsEmail($item, $key)
    {
        if (filter_var($item, FILTER_VALIDATE_EMAIL)) {
            return;//$this->message[] =  $key . ' is email';
        } else {
            return $this->message[] = $key . ' warning is not email';
        }
    }

    /**
     * @param $entry
     * @return string|void
     */
    private function varIsEmail($entry)
    {
        if (filter_var($entry, FILTER_VALIDATE_EMAIL)) {
            return;// $this->message = 'is email';
        } else {
            return $this->message = " warning is not email";
        }
    }

    /**
     * @param $entry
     */
    public function check($entry)
    {
        if (is_array($entry)) {

            array_walk_recursive($entry, array($this, 'arrayIsEmail'));
        } else {

            $this->varIsEmail($entry);
        }


    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }


}