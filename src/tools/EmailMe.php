<?php
  namespace blog\src\tools;

  /**
  * This Class can send emails Templates or Messages 
  */
  class EmailMe
  {
    
    public static function sendTemplateMail($to,$file,$subject)
    {
     // message
     $message = file_get_contents($file);
     // define header for html mail
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     // additional headers
     $headers .= 'From: Hamda Blog <sabri@hamda.ch>' . "\r\n";
     // Send
     mail($to, $subject, $message, $headers);
    }

    public static function sendMessageMail($to,$message,$subject)
    {
     // define header for html mail
     $headers  = 'MIME-Version: 1.0' . "\r\n";
     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
     // additional headers
     $headers .= 'From: Hamda Blog <sabri@hamda.ch>' . "\r\n";
     // Send
     mail($to, $subject, $message, $headers);
    }
  }
     
     
