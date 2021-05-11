<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Position;
use App\Entity\Candidate;
use App\Repository\DeveloperRepository;
use App\Repository\CandidateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PositionController extends AbstractController
{

    private $twig;
    private $entityManager;
    private $candidateWorkflow;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager,WorkflowInterface $candidateStateMachine)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
        $this->candidateStateMachine = $candidateStateMachine;
    }

    /**
     * @Route("/position", name="position_index")
     */
    public function index(): Response
    {
        return $this->render('position/index.html.twig', [
            'controller_name' => 'PositionController',
        ]);
    }


    /**
     *  @Route("/position/{slug}", name="position")
     */
    public function show(Position $position)
    {   
        //$this->candidateStateMachine->apply($position, 'accept');
        
        $user = $this->getUser();
        if(($user) AND ($user->getDeveloper()->getId()==$project->getOwner())){
            $showCandidateURL = $position->getSlug().'/candidates';
            $showCandidateText = 'Candidates';
        }

        return new Response($this->twig->render('position/show.html.twig',[
            'position' => $position,
            'showCandidateURL' => $showCandidateURL,
            'showCandidateText' => $showCandidateText,
        ]));
    }

    /**
     *  @Route("/position/{slug}/apply", name="position_aply")
     */
    public function apply(Position $position,DeveloperRepository $developerRepository)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $newCandidate = new Candidate();
        $Developer =  $developerRepository->find($user = $this->getUser()->getDeveloper());
        $newCandidate->setDeveloper($Developer);
        $newCandidate->setPosition($position);
        $this->entityManager->persist($newCandidate);
        $this->entityManager->flush();
        return new Response($this->twig->render('position/show.html.twig',[
            'position' => $position,
        ]));
    }


        /**
     *  @Route("/position/{slug}/candidates", name="position_candidate")
     */
    public function position_candidate(Position $position)
    {   
        $this->denyAccessUnlessGranted('owner',$position->getProject());
        return new Response($this->twig->render('position/show.html.twig',[
            'candidates' => $position->getCandidates(),
        ]));
    }




}
