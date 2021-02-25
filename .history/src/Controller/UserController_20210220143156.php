<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use App\Entity\User;

class UserController extends AbstractController {
    function index(LoggerInterface $logger) {
        $users = $this->getDoctrine()
                        ->getRepository(User::class)
                        ->findAll();

        $logger->info("Finding users");

        if(count($users) === 0) {
            $logger->warning("No users");
            return new Response('Could not find any users', 404);
        }

        return $this->render('users/index.html.twig', [
            "users" => $users
        ]);
    }

    function create() {
        return $this->render('users/create.html.twig');
    }

    function store(Request $request, LoggerInterface $logger) {
        $new_user = 
    }
}