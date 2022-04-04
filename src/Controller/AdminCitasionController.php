<?php

namespace App\Controller;

use App\Entity\Citasion;
use App\Form\CitasionType;
use App\Repository\CitasionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/citasion")
 */
class AdminCitasionController extends AbstractController
{
    /**
     * @Route("/", name="admin_citasion_index", methods={"GET"})
     */
    public function index(CitasionRepository $citasionRepository): Response
    {
        return $this->render('admin_citasion/index.html.twig', [
            'citasions' => $citasionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_citasion_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $citasion = new Citasion();
        $form = $this->createForm(CitasionType::class, $citasion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($citasion);
            $entityManager->flush();

            return $this->redirectToRoute('admin_citasion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_citasion/new.html.twig', [
            'citasion' => $citasion,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_citasion_show", methods={"GET"})
     */
    public function show(Citasion $citasion): Response
    {
        return $this->render('admin_citasion/show.html.twig', [
            'citasion' => $citasion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_citasion_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Citasion $citasion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CitasionType::class, $citasion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_citasion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_citasion/edit.html.twig', [
            'citasion' => $citasion,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_citasion_delete", methods={"POST"})
     */
    public function delete(Request $request, Citasion $citasion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$citasion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($citasion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_citasion_index', [], Response::HTTP_SEE_OTHER);
    }
}
