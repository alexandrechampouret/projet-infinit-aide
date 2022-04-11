<?php

namespace App\Controller;

use App\Repository\CitasionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    /** 
    * @Route("/")
    * @Route("/home", name= "home")
    */
    public function index(AuthenticationUtils $authenticationUtils, CitasionRepository $citasionRepository): Response
    {
        
        return $this->render('home/index.html.twig', [
            'home' => 'HomeController',
            'citasions' => $citasionRepository->findAll(),
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


    /** 
     * 
    * @Route("/declarerundeces", name= "declarerundeces")
    */
    public function declarerundeces(): Response
    {
        return $this->render('home/declarerdeces.html.twig', [
            'home' =>'HomeController',
        ]);
    }

    /** 
     * 
    * @Route("/servicefuneraire", name= "servicefuneraire")
    */
    public function servicefuneraire(): Response
    {
        return $this->render('home/servicefuneraire.html.twig', [
            'home' =>'HomeController',
        ]);
    }
    
}
