<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Repository\SkillSetRepository;
use App\Repository\ActivityRepository;
use App\Repository\DeveloperRepository;
use App\Repository\ProjectRepository;
use App\Form\CreateDeveloperFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class DeveloperController extends AbstractController
{
    private $twig;
    private $entityManager;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->twig = $twig;
        $this->entityManager = $entityManager;
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
    public function show(Developer $developer, SkillSetRepository $skillSetRepository, ActivityRepository $activityRepository)
    {   
        $activities = $activityRepository->findBy(['developer'=> $developer]);
        return new Response($this->twig->render('developer/show.html.twig',[
            'developer' => $developer,
            'skillsets' => $skillSetRepository->findBy(['developer' => $developer]),
            'activities' => $activities
        ]));
    }

    /**
     *  @Route("/create_developer", name="create_eveloper")
     */
    public function create_developer(Request $request)
    {   
        $newDeveloperAccount = new Developer();
        $form = $this->createForm(CreateDeveloperFormType::class, $newDeveloperAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newDeveloperAccount=$form->getData();
            $this->entityManager->persist($newDeveloperAccount);
            $this->entityManager->flush();
          

            return $this->redirectToRoute('developer',['slug' =>$newDeveloperAccount->getSlug()]);
        }

        return $this->render('developer/createDeveloperAccount.html.twig', [
            'create_form' => $form->createView(),
        ]);

    }

  

}
