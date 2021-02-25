<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController {
    function index() {
        $users = new ;

        return $this->render('users/index.html.twig', [
            "user" => $user
        ]);
    }
}