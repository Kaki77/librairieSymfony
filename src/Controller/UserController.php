<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Form\UserFormType;
use App\Form\PasswordFormType;
use App\Form\RolesFormType;
use App\Repository\UserRepository;
use App\Repository\ReservationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request,UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $em ): Response
    {
        {
            $utilisateur = new User();
            $form = $this->createForm(UserFormType::class, $utilisateur);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid())
            {
                    //encodage du mot de passe
                    $utilisateur->setPassword(
                    $passwordEncoder->encodePassword($utilisateur, $utilisateur->getPassword()));
                    $em->persist($utilisateur);
                    $em->flush();
    
                    return $this->redirectToRoute('home');
            }
    
            return $this->render('user/register.html.twig', [
            'utilisateur' => $utilisateur,
            'form' => $form->createView(),
            ]);
        }   
    }

    /**
     * @Route("/user",name="user")
     * @IsGranted("ROLE_ADMIN")
     */
    public function User(UserRepository $userRepo)
    {
        $user=$userRepo->findAll();
        return $this->render('user/index.html.twig',['utilisateur'=>$user]);
    }

    /**
     * @Route("/user/show",name="showUser")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function showUser(UserRepository $userRepo, ReservationRepository $reservationRepo)
    {
        $user=$userRepo->find($this->getUser()->getIdUser());
        $reservation=$reservationRepo->findBy(['idUser'=>$this->getUser()->getIdUser()]);
        return $this->render('user/showUser.html.twig',['utilisateur'=>$user,'reservation'=>$reservation]);
    }

    /**
     * @Route("/user/{id}/edit/password",name="editPassword")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function editPassword(User $user, Request $request, UserPasswordEncoderInterface $passwordEncoder,EntityManagerInterface $em)
    {
        $form=$this->createForm(PasswordFormType::class,$user);
        $form->HandleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
            $em->flush();
            if(in_array('ROLE_ADMIN',$this->getUser()->getRoles()))
            {
                return $this->redirectToRoute('user');
            }
            else
            {
                return $this->redirectToRoute('showUser');
            }
            
        }
        return $this->render('user/editPassword.html.twig',[
            'user'=>$user,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}/edit/roles",name="editRoles")
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function editRoles(User $user, Request $request,EntityManagerInterface $em)
    {
        $form=$this->createForm(RolesFormType::class,$user);
        $form->HandleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('user');
        }
        return $this->render('user/editRoles.html.twig',[
            'user'=>$user,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/user/{id}/delete",name="deleteUser")
     * @IsGranted("ROLE_SUPER_ADMIN")
     */
    public function deleteUser(User $user,Request $request,EntityManagerInterface $em)
    {
        $em->remove($user);
        $em->flush();
        return $this->redirectToRoute('user');
    }
}
