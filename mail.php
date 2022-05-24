<?php

    
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
        ->setUsername('fabienbrou99@gmail.com')
        ->setPassword('#FabienBrou99');
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $message = (new Swift_Message('Action effectué'))// Objet
        ->setFrom(['john@doe.com' => 'X-BANK'])// Le nom
        ->setTo(['fabienbrou99@gmail.com', 'other@domain.org' => 'A name'])
        ->setBody('Here is the message itself');

    // Send the message
    $result = $mailer->send($message);
    
    

?>