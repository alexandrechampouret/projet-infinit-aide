<?php

namespace App\Controller;

use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AssociationController extends AbstractController
{
    /**
     * @Route("/association", name="association")
     */
    public function index(AssociationRepository $associationrepository): Response
    {
        return $this->render('association/index.html.twig', [
            'associations' => $associationrepository->findall(),
        ]);
    }
}
