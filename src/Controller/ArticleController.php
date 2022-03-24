<?php

namespace App\Controller;

use App\Form\ArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name= "article")
     */
    public function index(): Response
    {
        return $this->render('article/index.html.twig', [
            'article' => 'ArticleController',
        ]);
    }

    /**
     * @Route("/listarticles", name= "listarticles")
     */
    public function listarticles(){
        // on accésde a la base de donnée d'article et on recupére tout les articles . 
        $articles = $this->getDoctrine()->getManager()->getRepository('App:Article')->findAll();
        dump($articles);
        $args = array('articles' => $articles);

        return $this->render('article/index.html.twig', $args);
    }

    /**
     * @Route("/addarticle", name= "addarticle")
     */

    public function addarticle(Request $request, EntityManagerInterface $entityManagerInterface){
        $user = $this->get('session')->get('user');
        $formulaire = $this->createForm(ArticleType::class);
        // Pour envoyer le formulaire (et ce qui apprait dans le bouton)
        $formulaire->add('formulaire_dinscription', SubmitType::class, ['label' => 'Ajouter']);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            // On recupére tout les données saisi par les  utilisateurs 
            $articleForm = $formulaire->getData();
            $articleBd = $entityManagerInterface->getRepository('App:Article')->findOneBy(array('titre' => $formulaire->get('titre')->getData())); 
            // On vérifie l'exsistance de l'article
            if($articleBd){
                // On modifie le contenu de l'article
                $articleBd->setDescription($formulaire->get('description')->getData());
            }else{
                //si n'exsiste pas on ajoute l'intégralité dans le form. 
                $entityManagerInterface->persist($articleForm);
            }
            
            $entityManagerInterface->flush();
            // On a joute un message de confirmation
            $this->addFlash("success", "Votre article a bien était créé");
            // On redirige vers la même page 
            $this->redirectToRoute('home');
    

        }
        if ($formulaire->isSubmitted()){
            // On gére les erreurs 
            $this->addFlash("error", "Erreur dans le Formulaire");
        }

        $args = array('form' => $formulaire->createView(), 'user' => $user);

        return $this->render('article/ajoutArticle.html.twig', $args);
        
    }

    
}
