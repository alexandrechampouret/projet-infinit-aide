<?php

namespace App\Controller;

use App\Entity\Association;
use App\Form\AssociationType;
use App\Repository\AssociationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/association")
 */
class AdminAssociationController extends AbstractController
{
    /**
     * @Route("/", name="admin_association_index", methods={"GET"})
     */
    public function index(AssociationRepository $associationRepository): Response
    {
        return $this->render('admin_association/index.html.twig', [
            'associations' => $associationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_association_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $association = new Association();
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($association);
            $entityManager->flush();

            return $this->redirectToRoute('admin_association_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_association/new.html.twig', [
            'association' => $association,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_association_show", methods={"GET"})
     */
    public function show(Association $association): Response
    {
        return $this->render('admin_association/show.html.twig', [
            'association' => $association,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_association_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Association $association, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_association_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_association/edit.html.twig', [
            'association' => $association,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_association_delete", methods={"POST"})
     */
    public function delete(Request $request, Association $association, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$association->getId(), $request->request->get('_token'))) {
            $entityManager->remove($association);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_association_index', [], Response::HTTP_SEE_OTHER);
    }
}
