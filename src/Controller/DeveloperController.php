<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Entity\Candidate;
use App\Repository\DeveloperRepository;
use App\Repository\ProjectRepository;
use App\Form\DeveloperEditIntroFormType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\Exception\LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DeveloperController extends AbstractController
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
     * @Route("/developer", name="developer_index")
     */
    public function index( DeveloperRepository $developerRepository)
    {


        return new Response($this->twig->render('developer/index.html.twig',[
            'developers' => $developerRepository->findAll(),
        ]));
        
    }

    /**
     *  @Route("/developer/{slug}", name="developer")
     */
    public function show(Developer $developer)
    {   
        $user = $this->getUser();
        if(($user) AND ($user->getDeveloper()==$developer)){
            $editIntroURL = $developer->getSlug().'/edit/intro';
            $edit = 'Edit';
        }
        

        return new Response($this->twig->render('developer/show.html.twig',[
            'developer' => $developer,
            'candidates'=> $developer->getCandidates(),
            'editIntroURL' => $editIntroURL,
            'edit' => $edit
        ]));
    }

    /**
     *  @Route("/developer/{slug}/edit/intro", name="developer_edit_intro")
     */
    public function developerEditIntro(Request $request,Developer $developer, DeveloperRepository $developerRepository)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'); 
        $user = $this->getUser();
        $developerId = $user->getUserId();
        $editDeveloperAccount =  $developerRepository->find($developerId);
        $form = $this->createForm(DeveloperEditIntroFormType::class, $editDeveloperAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($editDeveloperAccount);
            $this->entityManager->flush();
            return $this->redirectToRoute('developer',['slug' =>$editDeveloperAccount->getSlug()]);
        }

        return $this->render('developer/developerEditIntro.html.twig', [
            'create_form' => $form->createView(),
        ]);

    }

    /**
     *  @Route("/developer/{slug}/candidates", name="developer_candidates")
     */
    public function developerCandidates(Developer $developer)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if($user->getDeveloper() == $developer) {
            $candidates =  $developer->getCandidates();
        }

        return new Response($this->twig->render('developer/candidates.html.twig',[
            'candidates'=> $candidates,
            'developer'=> $developer
        ]));
    }

    /**
     *  @Route("/developer/{slug}/candidate/{candidate_slug}/validate", name="developer_candidate_validate")
     *  @ParamConverter("candidate", options={"mapping": {"candidate_slug": "slug"}})
     */
    public function developerCandidateValidate(Developer $developer, Candidate $candidate)
    {   
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        if($user->getDeveloper() == $candidate->getDeveloper()) {
            $this->candidateStateMachine->apply($candidate, 'validate');
            $position = $candidate->getPosition();
            $position->setUserId($developer->getId());
            $entityManager = $this->getDoctrine()->getManager();
            $this->entityManager->persist($position);
            $this->entityManager->persist($candidate);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('developer',['slug' =>$developer->getSlug()]);
    }
  

}
