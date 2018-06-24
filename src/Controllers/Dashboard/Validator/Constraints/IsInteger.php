<?php
/**
 * Created by Sabri Hamda.
 * Date: 22.06.18
 * Time: 21:04
 */

namespace src\Controllers\Dashboard\Validator\Constraints;

/**
 * Class IsInteger
 * @package src\Controllers\Dashboard\Validator\Constraints
 */
class IsInteger
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
    private function arrayIsInteger($item, $key)
    {
        if (filter_var($item, FILTER_VALIDATE_INT)) {
            return;//$this->message[] =  $key . ' is integer';
        } else {
            return $this->message[] = $key . ' warning is not integer';
        }
    }

    /**
     * @param $entry
     * @return string|void
     */
    private function varIsInteger($entry)
    {
        if (filter_var($entry, FILTER_VALIDATE_INT)) {
            return;//$this->message = ' is integer';
        } else {
            return $this->message = " warning is not integer";
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
            array_walk_recursive($entry, array($this, 'arrayIsInteger'));
        } else {

            $this->varIsInteger($entry);
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