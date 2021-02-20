<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use 
use Psr\Log\LoggerInterface;
use App\Entity\User;

class UserController extends AbstractController {
    function index(LoggerInterface $logger) {
        $users = new User();
        $users = $users->findAll();

        $logger->info("Finding users");

        if(count($users) === 0) {
            $logger->warn("No users");
            return new Response('Could not find any users');
        }

        return $this->render('users/index.html.twig', [
            "users" => $users
        ]);
    }
}