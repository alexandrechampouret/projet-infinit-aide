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
            // On recupére tout les données saisi par les  utilisateurs 
            $utilisateur = $formulaire->getData();

            // On hash le mot de passe
            $utilisateur->setMdp(sha1($formulaire->get('motdepasse')->getData()));
            // on donne notre variable a entity manager et flush-> pousse dans la BDD 
            $entityManagerInterface->persist($utilisateur);
            $entityManagerInterface->flush();
            // On a joute un message de confirmation
            $this->addFlash("success", "Votre a bien était créé");
            // On redirige vers la même page 
            $this->redirectToRoute('home');
    

        }
        if ($formulaire->isSubmitted()){
            // On gére les erreurs 
            $this->addFlash("error", "Erreur Inscription");
        }

        // RENDU
        return $this->render('user/index.html.twig', [
            // 'user' => $user,
            'form' => $formulaire->createView(),
        ]);
    }
}
