<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController {
    function index() {
        return $this->render('users/index.html.twig', );
    }
}