<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
