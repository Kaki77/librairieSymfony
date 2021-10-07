<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FournisseurRepository;
use App\Entity\Fournisseur;
use App\Form\FournisseurFormType;

class FournisseurController extends AbstractController
{
    /**
     * @Route("/fournisseur", name="fournisseur")
     */
    public function index(FournisseurRepository $fourRepo): Response
    {
        $four=$fourRepo->findAll();
        return $this->render('fournisseur/index.html.twig', [
            'controller_name' => 'FournisseurController',
            'fournisseur'=>$four,
        ]);
    }

    /**
     * @Route("/fournisseur/new",name="newFournisseur")
     */
    public function newFournisseur(Request $request, EntityManagerInterface $em)
    {
        $fournisseur=new Fournisseur();
        $form=$this->createForm(FournisseurFormType::class,$fournisseur);
        $form->HandleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $em->persist($fournisseur);
            $em->flush();
            $this->addFlash('message','Fournisseur ajouté avec succès !');
            return $this->redirectToRoute('fournisseur');
        }
        return $this->render('fournisseur/newFournisseur.html.twig',[
            'fournisseur'=>$fournisseur,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/fournisseur/{id}/edit",name="editFournisseur")
     */
    public function editFournisseur(Fournisseur $fournisseur, Request $request, EntityManagerInterface $em): Response
    {
        $form=$this->createForm(FournisseurFormType::class,$fournisseur);
        $form->HandleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $em->persist($fournisseur);
            $em->flush();
            $this->addFlash('message','Fournisseur modifié avec succès !');
            return $this->redirectToRoute('fournisseur');
        }
        return $this->render('fournisseur/editFournisseur.html.twig',[
            'fournisseur'=>$fournisseur,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/fournisseur/{id}/delete",name="deleteFournisseur")
     */
    public function deleteFournisseur(Fournisseur $fournisseur,Request $request,EntityManagerInterface $em)
    {
        $em->remove($fournisseur);
        $em->flush();
        $this->addFlash('message','Fournisseur modifié avec succès !');
        return $this->redirectToRoute('fournisseur');
    }
}
