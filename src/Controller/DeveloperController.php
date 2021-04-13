<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Form\DeveloperSignUpType;
use App\Repository\SkillSetRepository;
use App\Repository\ActivityRepository;
use App\Repository\DeveloperRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DeveloperController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }


    /**
     * @Route("/developer", name="developer_index")
     */
    public function index( DeveloperRepository $developerRepository)
    {
        $newDeveloperSignUp = new Developer();
        $form = $this->createForm(DeveloperSignUpType::class, $newDeveloperSignUp);

        return new Response($this->twig->render('developer/index.html.twig',[
            'developers' => $developerRepository->findAll(),
        ]));
        
    }

    /**
     *  @Route("/developer/{slug}", name="developer")
     */
    public function show(Developer $developer, SkillSetRepository $skillSetRepository, ActivityRepository $activityRepository)
    {   
        $activities = $activityRepository->findBy(['developer'=> $developer]);
        return new Response($this->twig->render('developer/show.html.twig',[
            'developer' => $developer,
            'skillsets' => $skillSetRepository->findBy(['developer' => $developer]),
            'activities' => $activities
        ]));
    }

  

}
