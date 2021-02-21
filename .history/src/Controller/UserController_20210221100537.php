<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\User;

class UserController extends AbstractController {
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $loggerInterface)
    {
        $this->logger = $loggerInterface
    }

    function index()
    {
        $users = $this
                    ->getDoctrine()
                    ->getRepository(User::class)
                    ->findAll();

        $this->logger->info('Searching for users');

        if(count($users) === 0) {
            $logger->warning("No users");
            return new Response('Could not find any users', 404);
        }

        return $this->render('users/index.html.twig', [
            "users" => $users
        ]);
    }

    public function edit(EntityManagerInterface $entityManagerInterface, $id)
    {
        $user = $entityManagerInterface->getRepository(User::class)->find($id);

        if(!$user)
        {
            $this->logger->warning("User with id = $id, does not exists");
            return new Res
        }

        return $this->render('users/edit.html.twig');
    }
}