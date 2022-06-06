<?php

namespace App\Controller;

use App\Form\EditProfileType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
            $images = $form->get('image')->getData();

             //On bloucle sur les images 
             foreach( $images as $image){
                 //on génére un nouveau nom de fichier
                  
                 $fichier = md5(uniqid()) . '.' . $image->guessExtension();

                 //On copie le fichier dans le dossier uploads
                 $image ->move(
                    $this->getParameter('images_directory'),
                    $fichier
                 );
                 //on stocke l'image dans la base de données (son nom)
                 $fichier='/uploads/'.$fichier;
                 $user -> setImage($fichier);
             }//
            $em->persist($user);
            $em->flush();

            $this->addFlash('message', 'Profil mis à jour');
            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/editprofile.html.twig', [
            'Edit' => $form->createView(),
        ]);
    }
    

    #[Route('/profile/pass', name: 'app_profile_pass')]
    public function editPass(Request $request, UserPasswordHasherInterface $userPasswordHasher )
    {
        if($request->isMethod('POST')){
            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            // On vérifie si les 2 mots de passe sont identiques
            if($request->request->get('pass') == $request->request->get('pass2')){
                $user->setPassword($userPasswordHasher->hashPassword($user, $request->request->get('pass')));
                
                $em->flush();
                $this->addFlash('message', 'Mot de passe mis à jour avec succès');

                return $this->redirectToRoute('app_users');
            }else{
                $this->addFlash('error', 'Les deux mots de passe ne sont pas identiques');
            }
        }

        return $this->render('profile/editpass.html.twig');
    }
    
}

