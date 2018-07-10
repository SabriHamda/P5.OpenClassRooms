<?php
/**
 * Created by Sabri Hamda.
 * Date: 10.07.18
 * Time: 11:40
 */

namespace src\Controllers\Frontend;


use src\Repository\UserRepository;

class ResetPasswordController extends Controller
{
    /**
     * if token exist show resetPasswordView page
     * @param $token this token comes from user mailbox
     */
    public function index($token)
    {
        if($this->checkToken($token))
        {
            $message = $this->message;
            echo $this->render('resetPasswordView.twig', ['user' => $this->user, 'message' => $message]);
        }
        $request = $this->getRequest();
        $request->redirect('/home',['message' => '<strong>Erreur ! </strong> Le format de votre image est incorrect']);
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
        if ($checkToken)
        {
            return true;
        }else {
            return false;
        }
    }
}