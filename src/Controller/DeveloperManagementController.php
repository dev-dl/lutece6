<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeveloperManagementController extends AbstractController
{
    /**
     * @Route("/developer_management", name="developer_management")
     */
    public function index(): Response
    {
        return $this->render('developer_management/index.html.twig', [
            'controller_name' => 'DeveloperManagementController',
        ]);
    }
}
