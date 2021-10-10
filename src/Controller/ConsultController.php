<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultController extends AbstractController
{
    /**
     * @Route("/consult", name="consult")
     */
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'ConsultController',
        ]);
    }
}
