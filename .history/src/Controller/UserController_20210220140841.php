<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;

class UserController extends AbstractController {
    function index() {
        $users = new User();
        $users = $users->fin

        return $this->render('users/index.html.twig', [
            "user" => $user
        ]);
    }
}