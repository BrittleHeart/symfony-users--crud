<?php

namespace App\Controller;

use LogicException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use UnexpectedValueException;

class HomeController extends AbstractController {

    /**
     * 
     * @return Response 
     * @throws LogicException 
     * @throws UnexpectedValueException 
     */
    function index(): Response {
        return $this->render('home/home.html.twig');
    }
}