<?php

// src/Controller/ContactController.php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request): Response
    {
        // ContactType formasini yaratish
        $form = $this->createForm(ContactType::class);

        // So'rovni forma bilan bog'lash
        $form->handleRequest($request);

        // Forma to'g'ri yuborilgan va validatsiyadan o'tganligini tekshirish
        if ($form->isSubmitted() && $form->isValid()) {
            // Foydalanuvchi ma'lumotlarini olish
            $data = $form->getData();

            // Ma'lumotlarni qayta ishlash (masalan, email yuborish yoki ma'lumotlar bazasiga yozish)

            // Foydalanuvchiga muvaffaqiyatli habar ko'rsatish
            $this->addFlash('success', 'Your message has been sent!');

            // Foydalanuvchini boshqa sahifaga yo'naltirish
            return $this->redirectToRoute('contact');
        }

        // Formani shablon bilan render qilish
        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
