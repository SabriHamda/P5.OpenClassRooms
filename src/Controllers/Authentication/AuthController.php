<?php

namespace src\Controllers\Authentication;

use src\Repository\UserRepository;
use src\Controllers\Frontend\Controller;

/**
 * Description of PostController.
 *
 * @author Sabri Hamda
 */
class AuthController extends Controller
{

    public function index()
    {
        if ($this->user->role === 'admin') {
            $this->getRequest()->redirect('/dashboard');
        } elseif ($this->user->role === 'visitor') {
            $this->getRequest()->redirect('/home');
        }
        echo $this->render('auth/login.twig');
    }

    public function login()
    {
        $user = new UserRepository();
        $request = $this->getRequest();
        $user->setEmail($request->post('email'));
        $user->setPassword($request->post('password'));
        if ($user->validate() && $user->login() && $user->getUserByEmail()->role === 'admin') {
            $request->redirect('/dashboard');
        } elseif ($user->validate() && $user->login() && $user->getUserByEmail()->role === 'visitor') {
            $request->redirect('/home');
        }
        $errors = $user->getErrors();
        $message = array_shift($errors);
        echo $this->render('auth/login.twig', ['message' => $message]);
    }

    public function logout()
    {
        blog()->getIdentity()->logout();
        $this->getRequest()->redirect('/home');
    }

    public function requestReset()
    {
        echo $this->render('recoveryView.twig');
    }

    public function sendRecoveryToken()
    {
        $user = new UserRepository();
        $request = $this->getRequest();
        $user->setEmail($request->post('email'));
        if ($user->generateToken()) {
            $request->redirect('/login', ['status' => 'alert-danger', 'message' => '<strong>Erreur ! </strong> Le format de votre image est incorrect']);
        }
        $errors = $user->getErrors();
        $message = array_shift($errors);
        echo $this->render('recoveryView.twig', ['message' => $message]);
    }

    public function validateResetToken()
    {

    }

    public function resetPassword()
    {

    }
}
