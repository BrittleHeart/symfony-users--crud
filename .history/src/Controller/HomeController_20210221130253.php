<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Con


class HomeController extends AbstractController {
    function index() {
        return $this->render('home/home.html.twig');
    }
}