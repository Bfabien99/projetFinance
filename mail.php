<?php

    function sendMail($objet,$message,$to){

        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
        ->setUsername('fabienbrou99@gmail.com')
        ->setPassword('#FabienBrou99');
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message($objet))// Objet
            ->setFrom(['john@doe.com' => 'X-BANK'])// Le nom
            ->setTo([$to, 'other@domain.org' => 'A name'])
            ->setBody($message)
            ->setContentType("text/html");

        // Send the message
        $result = $mailer->send($message);
        return $result;
    }
    
    
    

?>