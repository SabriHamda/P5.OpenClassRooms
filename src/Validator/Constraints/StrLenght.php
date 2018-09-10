<?php
/**
 * Created by Sabri Hamda.
 * Date: 08.07.18
 * Time: 19:15
 */

namespace app\Validator\Constraints;

/**
 * Class StrLenght
 * This Class filter lenght of entry given.
 * @package app\Validator\Constraints
 */
class StrLenght
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
    private function arrayStrLenght($item, $key)
    {
        if (strlen($item) >= 5 && strlen($item) <= 22) {
            return;
        }else {
            return $this->message[] = $key . ' warning MIN 6 characters and MAX 22';
        }
    }

    /**
     * @param $entry
     * @return string|void
     */
    private function varStrLenght($entry)
    {
        if (strlen($entry) >= 5 && strlen($entry) <= 22) {
            return;
        } else {
            return $this->message = " warning MIN 6 characters and MAX 22";
        }
    }

    /**
     * @param $entry
     */
    public function check($entry)
    {
        if (is_array($entry)) {
            foreach ($entry as $element => $key) {
                $containSubmit = stristr($element, 'submit');
            }
            unset($entry[$containSubmit]);
            array_walk_recursive($entry, array($this, 'arrayStrLenght'));
        } else {

            $this->varStrLenght($entry);
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