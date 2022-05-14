<?php

namespace App\Controller;

use App\Form\EditProfileType;
use App\Form\ChangePasswordFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
        ]);
    }
    
    #[Route('/profile/modifier', name: 'app_profile_modifier')]
    public function editProfile(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(EditProfileType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('users/editprofile.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
   
    #[Route('/profile/pass', name: 'app_profile_pass')]
            public function editpassword(Request $req, UserPasswordEncoderInterface $passwordEncoder): Response
            {
        
                $user = $this->security->getUser();
        
                $changePasswordForm = $this->createForm(ChangePasswordFormType::class, $user);
                $changePasswordForm->handleRequest($req);
        
                if ($changePasswordForm->isSubmitted() && $changePasswordForm->isValid()) {
                    $user->setPassword(
                        $passwordEncoder->encodePassword(
                            $user,
                            $changePasswordForm->get('plainPassword')->getData()
                        )
                    );
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->flush();
                }
        
            return $this->render('profile/editpass.html.twig', [
            'change_password_form' => $changePasswordForm->createView(),
            ]);
        
            }
    
}

