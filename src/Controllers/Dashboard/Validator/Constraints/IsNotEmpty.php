<?php
/**
 * Created by Sabri Hamda.
 * Date: 22.06.18
 * Time: 21:04
 */

namespace src\Controllers\Dashboard\Validator\Constraints;

/**
 * Class IsNotEmpty
 * @package src\Controllers\Dashboard\Validator\Constraints
 */
class IsNotEmpty
{
    /**
     * @var array
     */
    private $message = [];

    /**
     * @param $item
     * @param $key
     * @return string|void
     */
    private function arrayIsNotEmpty($item, $key)
    {
        if (!empty($item)) {
            return;//$this->message[] = $key . ' is not empty';
        } else {
            return $this->message[] = $key . ' warning is empty';
        }
    }

    /**
     * @param $entry
     * @return string|void
     */
    private function varIsNotEmpty($entry)
    {
        if (!empty($entry)) {
            return;//$this->message = ' is not empty';
        } else {
            return $this->message = ' warning is empty';
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
            array_walk_recursive($entry, array($this, 'arrayIsNotEmpty'));
        } else {

            $this->varIsNotEmpty($entry);
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