<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Repository\ActivityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class SettingController extends AbstractController
{

    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }
    
    /**
     * @Route("/setting", name="setting")
     */
    public function index()
    {
        return new Response($this->twig->render('setting/index.html.twig', [
            'controller_name' => 'SettingController',
        ]));
    }

    /**
     * @Route("/setting/profil", name="setting_profil")
     */
    public function editProfil()
    {
        return new Response($this->twig->render('setting/editProfil.html.twig', [
            'controller_name' => 'SettingController',
        ]));
    }



}
