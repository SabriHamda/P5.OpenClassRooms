<?php
namespace src\controllers\dashboard;

use src\controllers\dashboard\Controller;
use src\models\AdminUser;

/**
 * Description of PostController.
 *
 * @author Sabri Hamda
 */
class AuthController extends Controller
{

    public function index()
    {
        echo $this->render('auth/login.twig');
    }

    public function login()
    {
        $user = new AdminUser();
        $request = $this->getRequest();
        $user->setEmail($request->post('email'));
        $user->setPassword($request->post('password'));
        if ($user->validate() && $user->login()) {
            $request->redirect('/dashboard');
        }
        $errors = $user->getErrors();
        $message = array_shift($errors);
        echo $this->render('auth/login.twig', ['message' => $message]);
    }

    public function logout()
    {
        blog()->getIdentity()->logout();
        $this->getRequest()->redirect('/dashboard/login');
    }

    public function requestReset()
    {
       echo $this->render('auth/recovery.twig');
    }

    public function sendRecoveryToken()
    {
        $user = new AdminUser();
        $request = $this->getRequest();
        $user->setEmail($request->post('email'));
        if ($user->generateToken()) {
            $request->redirect('/dashboard/login', ['message'=> 'Please check your email for instructions.']);
        }
        $errors = $user->getErrors();
        $message = array_shift($errors);
        echo $this->render('auth/recovery.twig', ['message' => $message]);
    }

    public function validateResetToken()
    {
        
    }

    public function resetPassword()
    {
        
    }
}
