<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    private ProjectRepository $projectRepository;
    private EntityManagerInterface $entityManager;

    public function __construct( ProjectRepository $projectRepository, EntityManagerInterface $entityManager){
        $this->projectRepository = $projectRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/projet/{projectName}/{id}', name: 'app_project_show')]
    public function showProject(string $projectName, Project $project): Response
    {

        $projectUser = $this->projectRepository->findProjectUser($project);


        return $this->render('project.html.twig', [
            'projectName' => $projectName,
            'project' => $project,
        ]);
    }


}
