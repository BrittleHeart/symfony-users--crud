<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Entity\User;
use LogicException;
use UnexpectedValueException;

class UserController extends AbstractController {
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $loggerInterface)
    {
        $this->logger = $loggerInterface;
    }

    function index()
    {
        $users = $this
                    ->getDoctrine()
                    ->getRepository(User::class)
                    ->findAll();

        $this->logger->info('Searching for users');

        if(count($users) === 0) {
            $this->logger->warning("No users");
            return new Response('Could not find any users', 404);
        }

        return $this->render('users/index.html.twig', [
            "users" => $users
        ]);
    }

    /**
     * @Route("/users/edit/{id}", name="user-edit", methods="GET")
     * 
     * 
     * Allows edit user with form
     * 
     * @param EntityManagerInterface $entityManagerInterface 
     * @param int $id 
     * @return Response 
     * @throws LogicException 
     * @throws UnexpectedValueException
     * 
     */
    public function edit(EntityManagerInterface $entityManagerInterface, int $id): Response
    {
        $user = $entityManagerInterface
                    ->getRepository(User::class)
                    ->find(intval($id));

        if(!$user)
        {
            $this->logger->warning("User with id = $id, does not exists");
            return $this->redirect('/users', 302);
        }

        return $this->render('users/edit.html.twig', [
            "user" => $user,
            "id" => $id
        ]);
    }

    public function destroy()
}