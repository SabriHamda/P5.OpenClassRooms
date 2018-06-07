<?php
namespace etc\mail;

/**
 * Description of Mailer
 *
 * @author Sabri Hamda <sabri@hamda.ch>
 */
class Mailer
{

    static $instance;

    public static function getInstance()
    {
        if (self::$instance === null) {
            // Create the Transport
            $transport = (new \Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                ->setUsername('hamda.sab@gmail.com')
                ->setPassword('');
            self::$instance = new \Swift_Mailer($transport);
        }
        return self::$instance;
    }

    public function sendRecoveryToken($user)
    {
        $message = "Hello " . $user->getFullname() . "\n";
        $message .= "<a href=\"http://blog.local/dashboard/auth/password-reset?token={$user->password_reset_token}\">Click here</a> to reset your passowrd\n\n";
        return $this->sendMessage('Password reset', 'no-reply@hamda.ch', $user->email, $message);
    }

    private function sendMessage($subject, $from, $to, $body)
    {
        try {
            $message = (new \Swift_Message($subject))
                ->setFrom($from)
                ->setTo($to)
                ->setBody($body, 'text/html');
            return $this->getInstance()->send($message);
        } catch (\Exception $ex) {
            return false;
        }
    }
}
