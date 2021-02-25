<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
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

    function store(Request $request, LoggerInterface $logger, EntityManagerInterface $entityManager) {
        $new_user = new User();
        $new_user->setName($request->request->get('name'));
        $new_user->setEmail($request->request->get('email'));
        $new_user->setPassword($request->request->get('password'));

        $entityManager->persist($new_user);
        $entityManager->flush();

        return new Response("New user created $");
    }
}