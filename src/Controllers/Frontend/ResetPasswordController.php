<?php
/**
 * Created by Sabri Hamda.
 * Date: 10.07.18
 * Time: 11:40
 */

namespace app\Controllers\Frontend;


use app\Models\User;
use app\Repository\UserRepository;
use app\Validator\Constraints\IsNotEmpty;
use app\Validator\Constraints\StrLenght;
use app\Validator\Validator;

class ResetPasswordController extends FrontendController
{
    private $token;
    public $message = [];
    public $email;
    public $data;

    /**
     * if token exist show resetPasswordView page
     * @param $token this token comes from user mailbox
     */
    public function index($token)
    {
        $this->token = $token;
        setcookie('token', $this->token, time() + 365 * 24 * 3600, null, null, false, true);
        if ($this->checkToken($token)) {
            $userRepository = new UserRepository();
            $this->email = $userRepository->searchToken($token);
            $message = $this->message;
            echo $this->render('resetPasswordView.twig', ['user' => $this->user, 'message' => $message, 'email' => $this->email]);
        }
        $request = $this->getRequest();
        $request->redirect('/home');
    }

    /**
     * check in db if token exist
     * @param $token
     * @return bool
     */
    public function checkToken($token)
    {
        $userRepository = new UserRepository();
        $checkToken = $userRepository->searchToken($token);
        if ($checkToken) {
            return true;
        } else {
            return false;
        }
    }

    public function updatePassword()
    {
        $validator = new Validator();
        if ($validator->validate($this->getRequest()->post(), [new IsNotEmpty(), new StrLenght()])) {
            if ($this->getRequest()->post('passOne') == $this->getRequest()->post('passTwo')) {
                $userRepository = new UserRepository();
                $this->email = $userRepository->searchToken($_COOKIE['token']);
                $this->data = new User();
                $this->data->setPassword($this->getRequest()->post('passOne'));
                $userRepository->updatePassword($this->data, $this->email['email']);
                //post data to login
                $this->directLogin($this->email['email'],$this->getRequest()->post('passOne'));
                //end post data to login
                echo $this->render('loginView.twig');

            } else {
                $this->message[] = (['status' => 'alert-danger', 'message' => "<strong>Erreur ! </strong> les deux mot de passe doivent étres identiques !"]);
                echo $this->render('resetPasswordView.twig', ['user' => $this->user, 'message' => $this->message, 'email' => $this->email]);
            }
        } else {
            $this->message = $validator->getAlertMessages();
            echo $this->render('resetPasswordView.twig', ['user' => $this->user, 'message' => $this->message, 'email' => $this->email]);
        }
    }

    private function directLogin($email,$password)
    {
        $user = new UserRepository();
        $request = $this->getRequest();
        $user->setEmail($email);
        $user->setPassword($password);
        if ($user->validate() && $user->login() && $user->getUserByEmail()->role === 'admin') {
            $request->redirect('/dashboard');
        } elseif ($user->validate() && $user->login() && $user->getUserByEmail()->role === 'visitor') {
            $request->redirect('/home');
        }
        $errors = $user->getErrors();
        $message = array_shift($errors);
        $this->message [] = ['status' => 'alert-danger', 'message' => '<strong>Erreur ! </strong> ' . $message . ' !'];
        echo $this->render('/loginView.twig', ['message' => $this->message]);
    }
}