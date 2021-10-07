<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommandeRepository;
use App\Repository\LivreRepository;
use App\Repository\FournisseurRepository;
use App\Entity\Commande;
use App\Form\CommandeFormType;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index(CommandeRepository $commandeRepo, LivreRepository $livreRepo, FournisseurRepository $fournisseurRepo): Response
    {
        $commande=$commandeRepo->findAll();
        $livre=$livreRepo->findBy([],["titreLivre"=>"ASC"]);
        $fournisseur=$fournisseurRepo->findBy([],["raisonSociale"=>"ASC"]);
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
            'commande'=>$commande,
            'livre'=>$livre,
            'fournisseur'=>$fournisseur,   
        ]);
    }

    /**
     * @Route("/commande/new",name="newCommande")
     */
    public function newCommande(LivreRepository $livreRepo,Request $request, EntityManagerInterface $em)
    {
        $commande=new Commande();
        $form=$this->createForm(CommandeFormType::class,$commande);
        $form->HandleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $em->persist($commande);
            $em->flush();
            $this->addFlash('message','Nouvelle commande ajouté avec succès !');
            return $this->redirectToRoute('commande');
        }
        return $this->render('commande/newCommande.html.twig',[
            'commande'=>$commande,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/commande/{id}/edit",name="editCommande")
     */
    public function editCommande(Commande $commande, Request $request, EntityManagerInterface $em): Response
    {
        $form=$this->createForm(CommandeFormType::class,$commande);
        $form->HandleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $em->persist($commande);
            $em->flush();
            $this->addFlash('message','Commande modifié avec succès !');
            return $this->redirectToRoute('commander');
        }
        return $this->render('commande/editCommande.html.twig',[
            'commander'=>$commande,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/commande/{id}/delete",name="deleteCommande")
     */
    public function deleteCommande(Commande $commande,Request $request,EntityManagerInterface $em)
    {
        $em->remove($commande);
        $em->flush();
        $this->addFlash('message','Commande supprimé avec succès !');
        return $this->redirectToRoute('commande');
    }
}
