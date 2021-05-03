<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Position;
use APp\Entity\Developer;
use App\Repository\ProjectRepository;
use App\Form\ProjectCreateFormType;
use App\Form\PositionCrudFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ProjectController extends AbstractController
{
    private $twig;
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/project", name="project_index")
     */
    public function index(ProjectRepository $projectRepository): Response
    {

        return $this->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'controller_name' => 'ProjectController',
        ]);
    }

    /**
     *  @Route("/project/{slug}", name="project")
     */
    public function show(Project $project, ProjectRepository $projectRepository)
    {   
        $addPositionURL = $project->getSlug().'/add/position';

        return new Response($this->twig->render('project/show.html.twig',[
            'project' => $project,
            'addPositionURL' => $addPositionURL
        ]));
    }

    /**
     * @Route("/create_new_project", name="create_new_project")
     */
    public function create_new_project(Request $request): Response
    {
        $newProject = new Project();
        $form = $this->createForm(ProjectCreateFormType::class, $newProject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $this->entityManager->persist($newProject);
            $this->entityManager->flush();
            return $this->redirectToRoute('project',['slug' =>$newProject->getSlug()]);
        }

        return $this->render('project/createNewProject.html.twig', [
            'create_form' => $form->createView(),
        ]);
    }

    /**
     *  @Route("/project/{slug}/add/position", name="project_add_position")
     */
    public function project_add_position(Request $request,Project $project)
    {   
        $user = $this->getUser();      
        $newPosition = new Position();
        $form = $this->createForm(PositionCrudFormType::class, $newPosition);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newPosition->setAction("Created");
            $newPosition->setUserId($user->getId());
            $newPosition->setProjectId($project->getId());
            $entityManager = $this->getDoctrine()->getManager();
            $this->entityManager->persist($newPosition);
            $this->entityManager->flush();
            return $this->redirectToRoute('project',['slug' =>$project->getSlug()]);
        }

        return $this->render('project/projectAddPosition.html.twig', [
            'create_form' => $form->createView(),
        ]);
    }

    /**
     *  @Route("/project/{slug}/add/activity", name="project_add_activity")
     */
    public function project_add_activity(Project $project, ProjectRepository $projectRepository)
    {   
          
        return new Response($this->twig->render('project/show.html.twig',[
            'project' => $project
        ]));
    }

    /**
     *  @Route("/project/{slug}/edit/position", name="project_edit_position")
     */
    public function project_edit_position(Project $project, ProjectRepository $projectRepository)
    {   
          
        return new Response($this->twig->render('project/show.html.twig',[
            'project' => $project
        ]));
    }

}
