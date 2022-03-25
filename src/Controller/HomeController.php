<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /** 
    * @Route("/")
    * @Route("/home", name= "home")
    */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'home' => 'HomeController',
        ]);
    }

    /** 
    * 
    * @Route("/reperepratique", name= "reperepratique")
    */
    public function reperepratique(): Response
    {
        return $this->render('home/reperepratique.html.twig', [
            'home' =>'HomeController',
        ]);
    }


    /** 
    * 
    * @Route("/contact", name= "contact")
    */
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'contact' =>'HomeController',
        ]);
    }
}
