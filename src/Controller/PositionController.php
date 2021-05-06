<?php

namespace App\Controller;

use App\Entity\Position;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PositionController extends AbstractController
{

    private $twig;
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
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
        return new Response($this->twig->render('position/show.html.twig',[
            'position' => $position,
        ]));
    }

}
