<?php
/**
 * Created by Sabri Hamda.
 * Date: 22.06.18
 * Time: 21:04
 */

namespace src\Validator\Constraints;

/**
 * Class IsNotEmpty
 * @package src\Controllers\Dashboard\Articles\Validator\Constraints
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
        }
        $this->message[] = $key . ' warning is empty';

    }

    /**
     * @param $entry
     * @return string|void
     */
    private function varIsNotEmpty($entry)
    {
        if (!empty($entry)) {
            return;//$this->message = ' is not empty';
        }
        $this->message = ' warning is empty';
    }

    /**
     * @param $entry
     */
    public function check($entry)
    {
        if (is_array($entry)) {
            array_walk_recursive($entry, array($this, 'arrayIsNotEmpty'));
        }
        $this->varIsNotEmpty($entry);
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }


}