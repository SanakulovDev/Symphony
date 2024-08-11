<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    #[Route('/default/index', name: 'index')]
    public function index(): Response
    {

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    #[Route('/default/view/{name}', name: 'view')]
    public function view(String $name): Response
    {
        return $this->render('default/view.html.twig', [
            'controller_name' => 'DefaultController',
            'name'             => $name
        ]);
    }

    public function handleForm(Request $request): Response
    {
        $name = $request->query->get('name', 'Default Name');

        return $this->render('form/handle.html.twig', [
            'name' => $name,
        ]);
    }
            
}
