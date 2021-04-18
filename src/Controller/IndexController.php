<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {        
               
        return $this->render('index/index.html.twig', [
                'controller_name' => 'IndexController',]);

    }

    /**
    * @Route("/home", name="home")
     */
    public function home(): Response
    {                        
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY'); 
        return $this->render('index/index_authenticated.html.twig', [
            'controller_name' => 'IndexController',]);       
           
    }


}
