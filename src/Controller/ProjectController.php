<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\CreateProjectFormType;
use App\Form\UpdateProjectFormType;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    public function __construct
    (private ProjectRepository $projectRepository,
     private readonly EntityManagerInterface $entityManager,
     private UserRepository $userRepository){
    }


    #[Route(path: '/project/create', name: 'app_project_create')]
    public function createProject(Request $request): Response
    {
        $project = new Project();
        $form = $this->createForm(CreateProjectFormType::class, $project);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($project);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_project_show', [
                'id' => $project->getId(),
                'projectName' => $project->getName()
            ]);
        }

        return $this->render('project_create.html.twig', [
            'form' => $form
        ]);

    }
    #[Route('/project/{projectName}/{id}', name: 'app_project_show')]
    public function showProject(string $projectName, Project $project): Response
    {

        $projectUser = $project->getUsers();

        return $this->render('project.html.twig', [
            'projectName' => $projectName,
            'project' => $project,
            'projectUser' => $projectUser
        ]);
    }

    #[Route(path: '/project/{projectName}/{id}/remove', name: 'app_project_delete')]
    public function deleteProject( Project $project): Response
    {
        $project->setArchived(true);
        $this->entityManager->flush();
        return $this->redirectToRoute('app_home');
    }

    #[Route(path: '/project/{projectName}/{id}/update', name: 'app_project_update')]
    public function updateProject(Request $request, Project $project): Response
    {
        $form = $this->createForm(UpdateProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();
            return $this->redirectToRoute('app_project_show', [
                'id' => $project->getId(),
                'projectName' => $project->getName()
            ]);
        }

        return $this->render('project_update.html.twig', [
            'form' => $form,
            'project' => $project
        ]);
    }

}
