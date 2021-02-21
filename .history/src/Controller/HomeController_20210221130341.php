<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response;

class HomeController extends AbstractController {

    
    function index(): Response {
        return $this->render('home/home.html.twig');
    }
}