<?php

// src/Controller/HelloController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends AbstractController
{
    /**
     * @Route("/{name}", name="hello")
     */
    public function hello($name = 'World')
    {
        return new Response("Hello $name");
    } 
}