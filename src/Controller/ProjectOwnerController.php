<?php

namespace App\Controller;

use App\Entity\ProjectOwner;
use App\Form\ProjectOwnerType;
use App\Repository\ProjectRepository;
use App\Form\SearchOwnerType;
use App\Repository\ProjectOwnerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/project-owner')]
class ProjectOwnerController extends AbstractController
{
    #[Route('/', name: 'app_project_owner_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager,Request $request, ProjectOwnerRepository $projectOwnerRepository): Response
    {
        $form = $this->createForm(SearchOwnerType::class, null, [
            'method' => 'GET',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Call the search method in Exercise repository
            $project_owners = $projectOwnerRepository->search($data);
        }else{
            $project_owners = $projectOwnerRepository->findAll();
        }

        return $this->render('project_owner/index.html.twig', [
            'project_owners' => $project_owners,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'app_project_owner_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $projectOwner = new ProjectOwner();
        $form = $this->createForm(ProjectOwnerType::class, $projectOwner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($projectOwner);
            $entityManager->flush();

            $this->addFlash('success', 'Project owner created successfully');

            return $this->redirectToRoute('app_project_owner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('project_owner/new.html.twig', [
            'project_owner' => $projectOwner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_owner_show', methods: ['GET'])]
    public function show(ProjectOwner $projectOwner): Response
    {
        return $this->render('project_owner/show.html.twig', [
            'project_owner' => $projectOwner,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_project_owner_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProjectOwner $projectOwner, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjectOwnerType::class, $projectOwner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Project owner updated successfully');

            return $this->redirectToRoute('app_project_owner_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('project_owner/edit.html.twig', [
            'project_owner' => $projectOwner,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_project_owner_delete', methods: ['POST'])]
    public function delete(Request $request, ProjectOwner $projectOwner, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$projectOwner->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($projectOwner);
            $entityManager->flush();

            $this->addFlash('success', 'Project owner deleted successfully');
        }

        return $this->redirectToRoute('app_project_owner_index', [], Response::HTTP_SEE_OTHER);
    }
}
