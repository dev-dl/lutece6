<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Position;
use App\Entity\Candidate;
use App\Repository\DeveloperRepository;
use App\Repository\CandidateRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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

        $user = $this->getUser();
        $project = $position->getProject();
        if(($user) AND ($user->getDeveloper()->getId()==$project->getOwner())){
            $showCandidateURL = $position->getSlug().'/candidate_list';
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
        return $this->redirectToRoute('project_index');

    }


    /**
     *  @Route("/position/{slug}/candidate_list", name="position_candidate_list")
     */
    public function position_candidateList(Position $position)
    {   
        $this->denyAccessUnlessGranted('owner',$position->getProject());
        return new Response($this->twig->render('position/show.html.twig',[
            'position' => $position,
            'candidates' => $position->getCandidates(),
        ]));
    }

    /**
     *  @Route("/position/{slug}/candidate/{candidate_slug}", name="position_candidate")
     *  @ParamConverter("candidate", options={"mapping": {"candidate_slug": "slug"}})
     */
    public function position_candidate(Position $position, Candidate $candidate)
    {   
        $this->denyAccessUnlessGranted('owner',$position->getProject());
        return new Response($this->twig->render('position/candidate.html.twig',[
            'candidate' => $candidate,
            'position' => $position
        ]));
    }

    /**
     *  @Route("/position/{slug}/candidate/{candidate_slug}/accept", name="accept_candidate")
     *  @ParamConverter("candidate", options={"mapping": {"candidate_slug": "slug"}})
     */
    public function accept_candidate(Position $position, Candidate $candidate)
    {   
        $this->denyAccessUnlessGranted('owner',$position->getProject());

        $this->candidateStateMachine->apply($candidate, 'accept');
        $entityManager = $this->getDoctrine()->getManager();
        $this->entityManager->persist($candidate);
        $this->entityManager->flush();

        return $this->redirectToRoute('position_candidate_list',['slug' => $position->getSlug()]);

    }




}
