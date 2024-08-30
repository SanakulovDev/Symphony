<?php
// src/Controller/RegistrationController.php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserRegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; // Yangi interfeys

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserRegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($request->isMethod('POST')) {
            $postData = $request->request->all(); // Barcha POST ma'lumotlarni olish
            echo '<pre>';
            print_r($postData);
            echo '</pre>';
            exit; // Ma'lumotlarni ko'rsatish uchun kodni to'xtatish
        }
        if ($form->isSubmitted() && $form->isValid()) {

            // Parolni shifrlash
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Foydalanuvchini ma'lumotlar bazasiga saqlash
            $entityManager->persist($user);
            $entityManager->flush();

            // Registratsiyadan keyin foydalanuvchini login sahifasiga yo'naltirish
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
