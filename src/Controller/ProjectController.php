<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    public function __construct
    (private ProjectRepository $projectRepository,
     private EntityManagerInterface $entityManager,
     private UserRepository $userRepository){
    }

    #[Route('/projet/{projectName}/{id}', name: 'app_project_show')]
    public function showProject(string $projectName, Project $project): Response
    {

        $projectUser = $this->userRepository->findUsersByProject($project);

        return $this->render('project.html.twig', [
            'projectName' => $projectName,
            'project' => $project,
            'projectUser' => $projectUser
        ]);
    }


}
