<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(\Swift_Mailer $mailer)
    {
        $body =  $this->renderView(
            // templates/emails/registration.html.twig
            'emails/registration.html.twig',
            array('name' => 'Vicky')
        );
        $message = (new \Swift_Message('Hello Email'))
        ->setFrom('vichanse@yahoo.fr')
        ->setTo('vicky.nsenga@gmail.com')
        ->setBody($body
           ,
            'text/html'
        )
        /*
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
    ;
    try {
        $mailer->send($message);
    } catch (\Swift_TransportExcpetion $e) {
        echo $e->getMessage();
    }
    //var_dump($mailer->send($message));
        return $this->json([
            'message' => $body,
            'path' => 'src/Controller/MainController.php',
        ]);
    }
}
