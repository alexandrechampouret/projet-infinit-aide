<?php

namespace App\Controller;


use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
    public function inscription(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasher)
    {

        $formulaire = $this->createForm(UserType::class);
        // Pour envoyer le formulaire (et ce qui apprait dans le bouton)
        $formulaire->add('formulaire_dinscription', SubmitType::class, ['label' => 'Envoyer']);
        $formulaire->handleRequest($request);
        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            // On recupére tout les données saisi par les  utilisateurs 
            $utilisateur = $formulaire->getData();
            // On hash le mot de passe
            $utilisateur->setPassword(
                $userPasswordHasher->hashPassword(
                        $utilisateur,
                        $formulaire->get('password')->getData()
                    )
                );

            // autre methode de hashage 
            // $utilisateur->setPassword(sha1($formulaire->get('motdepasse')->getData()));

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