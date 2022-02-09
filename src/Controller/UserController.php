<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends AbstractController
{
    /** 
    * @Route("/user", name= "user")
    */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'utilisateur' => 'UserController',
        ]);
    }
    /** 
    * @Route("/register", name= "inscription")
    */
    public function inscription(Request $request, EntityManagerInterface $entityManagerInterface)
    {

        $formulaire = $this->createForm(UserType::class);
        $formulaire->add('Envoyer', SubmitType::class, ['label' => 'Formulaire d\'inscription']);
        $formulaire->handleRequest($request);
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $utilisateur = $formulaire->getData();

            // On hash le mot de passe
            $utilisateur->setMdp(sha1($formulaire->get('motdepasse')->getData()));

            $entityManagerInterface->persist($utilisateur);
            $entityManagerInterface->flush();
        }
    }
}
