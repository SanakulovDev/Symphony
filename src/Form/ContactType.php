<?php
// src/Form/ContactType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Your Name',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please enter your name',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Your Email',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please enter your email',
                    ]),
                    new Assert\Email([
                        'message' => 'Please enter a valid email address',
                    ]),
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Your Message',
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Please enter a message',
                    ]),
                    new Assert\Length([
                        'min' => 10,
                        'minMessage' => 'Your message should be at least {{ limit }} characters',
                    ]),
                ],
            ]);
    }
}
