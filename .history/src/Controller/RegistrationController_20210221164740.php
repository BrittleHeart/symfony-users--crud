<?php

// namespace App\Controller;

// use App\Entity\User;
// use App\Form\UserType;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

// class RegistrationController extends AbstractController
// {
//     private $passwordEncoder;

//     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
//     {
//         $this->passwordEncoder = $passwordEncoder;
//     }

//     /**
//      * @Route("/registration", name="registration")
//      */
//     public function index(Request $request)
//     {
//         // Close route if authenticated
//         if($this->isGranted('IS_AUTHENTICATED_FULLY'))
//             return $this->redirect('/users');

//         $user = new User();

//         $form = $this->createForm(UserType::class, $user);

//         $form->handleRequest($request);

//         if ($form->isSubmitted() && $form->isValid()) {
//             // Encode the new users password
//             $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

//             // Set their role
//             $user->setRoles(['ROLE_USER']);
//             $user->setCreatedAt(new \DateTime());

//             // Save
//             $em = $this->getDoctrine()->getManager();
//             $em->persist($user);
//             $em->flush();

//             return $this->redirectToRoute('app_login');
//         }

//         return $this->render('security/register.html.twig', [
//             'form' => $form->createView(),
//         ]);
//     }
// }