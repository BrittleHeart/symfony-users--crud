<?php

namespace App\Controller;

use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UnexpectedValueException;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home", methods="GET")
     * 
     * 
     * Loads main page
     * 
     * @return Response 
     * @throws LogicException 
     * @throws UnexpectedValueException 
     */
    function index(): Response {
        if($this->get('twig')->)
        return $this->render('home/home.html.twig');
    }
}