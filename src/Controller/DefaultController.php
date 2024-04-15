<?php

namespace App\Controller;

use App\Repository\ProjectOwnerRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function __invoke(ProjectRepository $projectRepository, ProjectOwnerRepository $projectOwnerRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'lastProjects' => $projectRepository->findLastProjects(),
            'gender_repartition' => $projectOwnerRepository->getGenderRepartitionForChartJS(),
        ]);
    }
}