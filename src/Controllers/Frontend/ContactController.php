<?php
/**
 * Created by PhpStorm.
 * UserRepository: admin
 * Date: 05.06.18
 * Time: 18:46
 */

namespace src\Controllers\Frontend;
use src\Validator\Constraints\IsEmail;
use src\Validator\Constraints\IsNotEmpty;
use src\Validator\Validator;


class ContactController extends FrontendController
{
    public $message = [];

    public function index()
    {
        $message = $this->message;
        echo $this->render('contact.twig',['user'=>$this->user,'message' => $message]);
    }

    public function validateContact()
    {
        $validator = new Validator();
        $request = $this->getRequest();
        if ($validator->validate($request->post(),[new IsNotEmpty()]) && $validator->validate($request->post('contact-email'),[new IsNotEmpty(), new IsEmail()]))
        {
            $this->sendEmail(
                'Blog Contact',
                'sabri@hamda.ch',
                'sabri@hamda.ch',('nom : '.$request->post('contact-name').'<br> email : '.$request->post('contact-email').'<br> Phone : '.$request->post('contact-phone').'<br> Message : '.$request->post('contact-message'))
            );
            $this->message = ['status' => 'alert-danger', 'message' => "<strong>Erreur ! </strong> Le format de votre image est incorrect"];

        }
        $this->message = $validator->getAlertMessages();
        return $this->index();



    }

    public function sendEmail($subject, $from, $to, $body)
    {
        blog()->getMailer()->sendMessage($subject, $from, $to, $body);
    }
}