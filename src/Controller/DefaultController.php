<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/default', name: 'app_default')]
    public function index(): Response
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('/view/{name}', name: 'view')]
    public function view(String $name): Response
    {
        return $name;
        return $this->render('default/view.html.twig', [
            'controller_name' => 'DefaultController',
            'name'             => 'Anvar Sanakulov'
        ]);
    }
}
