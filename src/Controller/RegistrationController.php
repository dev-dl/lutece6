<?php

namespace App\Controller;

use App\Entity\UserAuths;
use App\Entity\Developer;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use App\Repository\UserAuthsRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $newUser = new UserAuths();
        $newDeveloper = new Developer();
        $form = $this->createForm(RegistrationFormType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $newUser->setPassword(
                $passwordEncoder->encodePassword(
                    $newUser,
                    $form->get('plainPassword')->getData()
                )
            );

            $newDeveloper->setEmail($form->get('email')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            
            $entityManager->persist($newDeveloper);
            $entityManager->flush();
            $newUser->setDeveloper($newDeveloper);
            $entityManager->persist($newUser);
            $entityManager->flush();
          

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


}
