<?php

namespace App\Controller;

use App\Entity\Position;
use App\Entity\Candidate;
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
        $this->entityManager->flush();
        return new Response($this->twig->render('position/show.html.twig',[
            'position' => $position,
        ]));
    }




}
