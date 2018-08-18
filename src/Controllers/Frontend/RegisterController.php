<?php
/**
 * Created by PhpStorm.
 * UserRepository: admin
 * Date: 05.06.18
 * Time: 19:24
 */

namespace src\Controllers\Frontend;


use src\Controllers\Authentication\AuthController;
use src\Models\User;
use src\Repository\UserRepository;
use src\Validator\Constraints\IsEmail;
use src\Validator\Constraints\IsNotEmpty;
use src\Validator\Validator;

class RegisterController extends FrontendController
{
    public $message = [];
    private $data;

    public function index()
    {

        $message = $this->message;
        echo $this->render('registerView.twig', ['user' => $this->user, 'message' => $message]);
    }

    public function addUser()
    {
        $validator = new Validator();
        $request = blog()->getRequest();
        if ($validator->validate($request->post(), [new IsNotEmpty()]) && $validator->validate($request->post('email'), [new IsEmail()])) {
            if ($request->post('password') == $request->post('passwordConfirm')) {
                $this->data = new User();
                $this->data->setRole('visitor');
                $this->data->setCivility($request->post('civility'));
                $this->data->setName($request->post('name'));
                $this->data->setEmail($request->post('email'));
                $this->data->setPassword($request->post('password'));
                $userRepository = new UserRepository();
                $userRepository->addUser($this->data);
                $auth = new AuthController($request);
                $auth->login($request->post('email'), $request->post('password'));
            } else {
                $this->message[] = ['status' => 'alert-danger', 'message' => "<strong>Erreur ! </strong> Mots de Passe non identiques"];
                return $this->index();
            }
            $this->message = $validator->getAlertMessages();
            return $this->index();

        }else{
            $this->message = $validator->getAlertMessages();
            return $this->index();
        }
    }

    private function passwordConfirm($passOne, $passTwo)
    {
        if ($passOne == $passTwo) {
            return true;
        }
        return false;
    }
}