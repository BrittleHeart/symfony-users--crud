<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use UnexpectedValueException;
use Psr\Log\LoggerInterface;
use App\Entity\User;
use App\Form\UpdateUserType;
use LogicException;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class UserController extends AbstractController {
    private LoggerInterface $logger;
    private UserPasswordEncoderInterface $encoder;
    private CsrfTokenManagerInterface $csrfTokenManagerInterface

    public function __construct(LoggerInterface $loggerInterface, CsrfTokenManagerInterface $csrfTokenManagerInterface, UserPasswordEncoderInterface $encoder)
    {
        $this->logger = $loggerInterface;
        $this->encoder = $encoder;
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
    public function edit(EntityManagerInterface $entityManagerInterface, Request $request, int $id): Response
    {
        $user = $entityManagerInterface
                    ->getRepository(User::class)
                    ->find(intval($id));

        $form = $this->createForm(UpdateUserType::class, $user, ['action' => $this->generateUrl('user-update', ['id' => $id])]);

        if(!$user)
        {
            $this->logger->warning("User with id = $id, does not exists");
            return $this->redirect('/users', 302);
        }


        return $this->render('users/edit.html.twig', [
            "user" => $user,
            "id" => $id,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/users/{id}", name="user-update", methods="PUT")
     * 
     * 
     * Updates user's password
     * 
     * @param Request $request 
     * @param EntityManagerInterface $entityManagerInterface 
     * @param int $id 
     * @return Response 
     * @throws NotFoundHttpException 
     */
    public function update(Request $request, EntityManagerInterface $entityManagerInterface, int $id): Response
    {
        $form_fields = $request->request->get('update_user');

        $token = $form_fields['_token'];
        // print_r($token);
        // die;

        if(!$this->isCsrfTokenValid('_token', $token))
        {
            $this->logger->critical('CSRF token is invalid');
            return new Response('CSRF Token is invalid <a href="/users">Back</a>', 403);
        }

        $user = $entityManagerInterface
                    ->getRepository(User::class)
                    ->find($id);

        if(!$user)
        {
            $this->logger->error("User with id = $id does not exists");
            throw new NotFoundHttpException('Could not find user');
        }


        $password = htmlspecialchars($form_fields['password']);
        
        $user->setPassword($this->encoder->encodePassword($user, $password));

        $entityManagerInterface->persist($user);
        $entityManagerInterface->flush();

        return $this->redirect('/users');
    }

    /**
     * @Route("/users/delete/{id}", name="user-delete", methods="GET")
     * 
     * 
     * Relete user
     * 
     * @param int $id 
     * @return string 
     */
    public function destroy(int $id): Response
    {
        return new Response("User with id = $id has been deleted", 200);
    }
}