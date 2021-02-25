<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sym


class HomeController extends AbstractController {
    function index() {
        return $this->render('home/home.html.twig');
    }
}