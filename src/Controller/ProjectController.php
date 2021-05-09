<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Position;
use APp\Entity\Developer;
use App\Repository\ProjectRepository;
use App\Repository\PositionRepository;
use App\Form\ProjectCreateFormType;
use App\Form\PositionCrudFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ProjectController extends AbstractController
{
    private $twig;
    private $entityManager;
    private $candidateWorkflow;


    public function __construct(Environment $twig, EntityManagerInterface $entityManager,  WorkflowInterface $candidateStateMachine)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->candidateStateMachine = $candidateStateMachine;
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
    public function show(Project $project)
    {   
        $user = $this->getUser();
        if(($user) AND ($user->getUserId()==$project->getOwner())){
            $addPositionURL = $project->getSlug().'/add/position';
            $addPositionText = 'Add Position';

            $editProjectURL = $project->getSlug().'/edit';
            $editProjectText = 'Edit Project';
        }

        return new Response($this->twig->render('project/show.html.twig',[
            'project' => $project,
            'addPositionURL' => $addPositionURL,
            'addPositionText' => $addPositionText, 
            'positions'=> $project->getPositions(),
            'editProjectURL' => $editProjectURL,
            'editProjectText' => $editProjectText
        ]));
    }

    /**
     * @Route("/create_new_project", name="create_new_project")
     */
    public function create_new_project(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $newProject = new Project();
        $form = $this->createForm(ProjectCreateFormType::class, $newProject);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $newProject->setOwner($this->getUser()->getUserId());
            $this->entityManager->persist($newProject);
            $this->entityManager->flush();
            return $this->redirectToRoute('project',['slug' =>$newProject->getSlug()]);
        }

        return $this->render('project/createNewProject.html.twig', [
            'create_form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/project/{slug}/edit", name="edit_project")
     */
    public function edit_project(Request $request, project $project): Response
    {
        $this->denyAccessUnlessGranted('owner',$project);
        $form = $this->createForm(ProjectCreateFormType::class, $project);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $this->entityManager->persist($project);
            $this->entityManager->flush();
            return $this->redirectToRoute('project',['slug' =>$project->getSlug()]);
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

        $this->denyAccessUnlessGranted('owner',$project);
              
        $newPosition = new Position();
        $form = $this->createForm(PositionCrudFormType::class, $newPosition);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newPosition->setProject($project);
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
     *  @Route("/project/{slug}/edit/position", name="project_edit_position")
     */
    public function project_edit_position(Project $project, Position $position)
    {  

        /* must go to positionController to edit this

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'); 
        $form = $this->createForm(DeveloperEditIntroFormType::class, $position);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($position);
            $this->entityManager->flush();
            return $this->redirectToRoute('project',['slug' =>$project->getSlug()]);
        }

        return $this->render('project/projectAddPosition.html.twig', [
            'create_form' => $form->createView(),
        ]);
        */
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



}
