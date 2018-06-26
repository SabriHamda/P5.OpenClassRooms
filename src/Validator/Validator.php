<?php
/**
 * Created by Sabri Hamda.
 * Date: 21.06.18
 * Time: 14:47
 */

namespace src\Validator;
/**
 * Class Validator
 * @package src\Controllers\Dashboard\Articles\Validator
 */
class Validator
{
    /**
     * @var array all violations in array ex: is empty, is not integer ...
     */
    private $violations = [];
    /**
     * @var array return all messages to the view
     */
    private $alertMessages = [];

    /**
     * @param $entry
     * @param array $constraints
     * @return bool|void
     */
    public function validate($entry, $constraints = [])
    {
        if (empty($constraints)) {
            return;
        }
        foreach ($constraints as $constraint) {
            $constraint->check($entry);
            $this->violations[] = $constraint->getMessage();
        }
        //extract message from array
        $allViolations = array_filter($this->getViolations());

        if (!empty($allViolations)) {
            for ($i = 0; $i <= count($allViolations); $i++) {
                if (stristr($allViolations[$i][$i], 'is empty')) {
                    array_push($this->alertMessages, ['status' => 'alert-danger', 'message' => '<strong>Erreur!</strong> Un ou plusieurs champs sont vide.']);
                } elseif (stristr($allViolations[$i][$i], 'is not email')) {
                    array_push($this->alertMessages, ['status' => 'alert-danger', 'message' => '<strong>Erreur!</strong> Le champ email doit contenir un email valid.']);
                } elseif (stristr($allViolations[$i][$i], 'is not integer')) {
                    array_push($this->alertMessages, ['status' => 'alert-danger', 'message' => '<strong>Erreur!</strong> Le champ nombre doit contenir un nombre.']);
                }

            }
        } else {
            array_push($this->alertMessages, ['status' => 'alert-success', 'message' => '<strong>Succès ! </strong> informations validées avec succès.']);

        }
        $this->alertMessages = array_unique($this->alertMessages);

        if (empty(array_filter($this->violations))) {
            return true;
        } else {
            return false;

        }
    }

    /**
     * @return array
     */
    public function getViolations()
    {
        return $this->violations;
    }

    /**
     * @return array
     */
    public function getAlertMessages()
    {
        return $this->alertMessages;
    }
}
