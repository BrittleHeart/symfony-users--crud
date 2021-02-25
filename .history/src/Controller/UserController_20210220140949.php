<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Entity\User;

class UserController extends AbstractController {
    function index(LoggerInterface $logger) {
        $users = new User();
        $users = $users->findAll();

        return $this->render('users/index.html.twig', [
            "users" => $users
        ]);
    }
}