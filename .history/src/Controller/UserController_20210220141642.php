<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Psr\Log\LoggerInterface;
use App\Entity\User;

class UserController extends AbstractController {
    function index(LoggerInterface $logger) {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $logger->info("Finding users");

        if(count($users) === 0) {
            $logger->warning("No users");
            return new Response('Could not find any users');
        }

        return $this->render('users/index.html.twig', [
            "users" => $users
        ]);
    }
}