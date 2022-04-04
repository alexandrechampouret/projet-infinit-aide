<?php

namespace App\Controller;


use App\Form\UserType;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    // /** 
    // * @Route("/user", name= "user")
    // */
    // public function index(): Response
    // {
    //     return $this->render('user/index.html.twig', [
    //         'utilisateur' => 'UserController',
    //     ]);
    // }

    /** 
    * @Route("/profile", name= "profile")
    */
    public function profile(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, EntityManagerInterface $entityManagerInterface ): Response
    {
        //On recupére le user actif dans une varibale user
        $user = $this->getUser();
        //Formulaire de changement user
        $form = $this->createForm(UserType::class, $user);
        // on hydrate (mettre données dedans)
        $form->handleRequest($request);
        //On traite les données 
        if($form->isSubmitted() && $form->isValid()){
            //On met a jour le mots de pass encodé de l'user si il a saisie un nouveau 
            $plainPassword = $form->get('password')->getData();
            if(!is_null($plainPassword)){
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                            $user,
                            $plainPassword
                        )
                    );
                }

            // on donne notre variable a entity manager et flush-> pousse dans la BDD 
            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();
                // ajout message confirmation 
            $this->addFlash("succes", "Vos information on bien était mis a jour.");
            //on redirige vers la meme page
            $this->redirecteToRoute('profile');

        }
        return $this->render('user/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    // /** 
    // * @Route("/register", name= "inscription")
    // */
    // public function inscription(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasherInterface)
    // {
    //     // On teste si anonyme
    //     // $user = $this->get('session')->get('user');
    //     $user = $this->getUser();

    //     $utilisateur = $this->getUserDB($user);

    //     if($utilisateur == null) {
    //         $formulaire = $this->createForm(UserType::class);
    //         // Pour envoyer le formulaire (et ce qui apprait dans le bouton)
    //         $formulaire->add('formulaire_dinscription', SubmitType::class, ['label' => 'Envoyer']);
    //         $formulaire->handleRequest($request);
    //         if ($formulaire->isSubmitted() && $formulaire->isValid()) {
    //             // On recupére tout les données saisi par les  utilisateurs 
    //             $utilisateur = $formulaire->getData();
    //             // On hash le mot de passe
    //             $utilisateur->setPassword(
    //                 $userPasswordHasherInterface->hashPassword(
    //                         $utilisateur,
    //                         $formulaire->get('password')->getData()
    //                     )
    //                 );

    //             // autre methode de hashage 
    //             // $utilisateur->setPassword(sha1($formulaire->get('motdepasse')->getData()));

    //             // on donne notre variable a entity manager et flush-> pousse dans la BDD 
    //             $entityManagerInterface->persist($utilisateur);
    //             $entityManagerInterface->flush();
    //             // On a joute un message de confirmation
    //             $this->addFlash("success", "Votre profile a bien était créé");
    //             // On redirige vers la même page 
    //             $this->redirectToRoute('home');
        

    //         }
    //         // if ($formulaire->isSubmitted()){
    //         //     // On gére les erreurs 
    //         //     $this->addFlash("error", "Erreur Inscription");
    //         // }
 
    //         // RENDU
    //         return $this->render('user/inscription.html.twig', [
    //             'user' => $user,
    //             'form' => $formulaire->createView(),
    //         ]);
    //     }else {
    //         throw $this->createNotFoundException('Cette page n\'est accessible que par les utilisateurs non inscrits');
    //     }
        
    // }

    /** 
    * @Route("/login", name= "connexion")
    */
    public function connexion(Request $request, EntityManagerInterface $entityManagerInterface, UserPasswordHasherInterface $userPasswordHasher)
    {
        
        
        //récupere le user présent dans la session 
        $userBd = $this->get('session')->get('user');
        

        if ($userBd == null){
            
            $formulaire = $this->createForm(LoginType::class);
            // Pour envoyer le formulaire (et ce qui apprait dans le bouton)
            $formulaire->add('formulaire_connexion', SubmitType::class, ['label' => 'Connexion']);
            $formulaire->handleRequest($request);
            if ($formulaire->isSubmitted() && $formulaire->isValid()) {
                // on recupére l'email saisi par l'utilisateur 
                $userBd = $this->getUserDB($formulaire->get('email')->getData());
                $mdpFormulaire = $formulaire->get('password')->getData();

                // Vérifier si le mdp est correct
                $isMdpCorrect = $userPasswordHasher->isPasswordValid($userBd, $mdpFormulaire);
                if($isMdpCorrect) {

                }
                else{
                    $this->addFlash('error', 'Le mots de passe n\'est pas valide');
                    // getUri= elle rafraichi la page aprés error de login 
                    return $this->redirect($request->getUri());
                }
                $this->addFlash('succes', 'Vous êtes bien connecté');
                return $this->redirectToRoute('home');
        
            }

            // RENDU
            return $this->render('user/login.html.twig', [
                'user' => $userBd,
                'formLogin' => $formulaire->createView(),
            ]);
        }
        else{
 
            // test de la fonction
            $this->addFlash('error', 'Vous etes déjà authentifié.');
            return $this->render('user/index.html.twig', array('user' => $userBd));
        }
    }
 
    
 
    
    // elle retourne tout les donnée d'un user dans la base donnée . 
    public function getUserDB($email) {

        // on retourne un objet de type user récupérer sur la base de donnée. et chercher avec le mail 
        // Doctrine : librairie qui la base de donnée 
        // manager entity manager 
        return $this->getDoctrine()->getManager()
            ->getRepository('App:User')
            ->findOneBy(array('email'=>$email));
    }


}