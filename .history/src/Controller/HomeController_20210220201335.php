<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController {
    function index() {
        return $this->render('home/home.html.twig');
    }

    function contact() {
        return $this->render('contact')
    }
}