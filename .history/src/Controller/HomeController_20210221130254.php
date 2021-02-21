<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Compo


class HomeController extends AbstractController {
    function index() {
        return $this->render('home/home.html.twig');
    }
}