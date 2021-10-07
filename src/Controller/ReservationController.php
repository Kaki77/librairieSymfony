<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Reservation;
use App\Entity\Livre;
use App\Entity\User;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation/{id}", name="reservation")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function index(Livre $livre)
    {
        return $this->render('reservation/index.html.twig', [
            'livre'=>$livre,
        ]);
    }

    /**
     * @Route("/reservation/{id}/validate", name="reservation_validate")
     */
    public function validate(Livre $livre,EntityManagerInterface $em, MailerInterface $mailer)
    {
        /*
        $email=(new Email())
        ->from('admin@wampserver.invalid')
        ->to('admin@wampserver.invalid')
        ->subject('Mail avec Symfony')
        ->text('Ce mail est envoyé avec Mailer de Symfony')
        ->html('<p>Hello World!</p>');
        
        $mailer->send($email);
        */
        $reservation=new Reservation();
        $reservation->setDateReservation(new \DateTime());
        $reservation->setPrixReservation($livre->getPrixLivre());
        $reservation->setEstPaye(false);
        $reservation->setIdUser($this->getUser());
        $reservation->addIdLivre($livre);
        $em->persist($reservation);
        $em->flush();
        $this->addFlash('message','Réservation validé');
        return $this->redirectToRoute('home');
    }
}
