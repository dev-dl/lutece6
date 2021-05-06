<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PositionController extends AbstractController
{
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

}
