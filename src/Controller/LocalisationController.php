<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManager;


class LocalisationController extends AbstractController
{
    #[Route('/localisation', name: 'app_localisation')]
    public function index(): Response
    {
        return $this->render('localisation/index.html.twig', [
            'controller_name' => 'LocalisationController',
        ]);
    }
    #[Route('/localisation/save', name: 'save_localisation')]
    public function save(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
       $currentUser = $this->getDoctrine()->getRepository(Users::class)->find($this->getUser()->getId());
       $currentUser->setLongitude($request->request->get('long'));
       $currentUser->setLat($request->request->get('lat'));
        $em->flush();

        return $this->redirectToRoute("app_users");
    }
}
