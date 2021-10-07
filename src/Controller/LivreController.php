<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\LivreRepository;
use App\Repository\ThemeLivreRepository;
use App\Entity\Livre;
use App\Form\LivreFormType;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class LivreController extends AbstractController
{
    /**
     * @Route("/livre", name="livre")
     */
    public function index(LivreRepository $livreRepo, ThemeLivreRepository $themeRepo): Response
    {
        $livre=$livreRepo->findBy([],["titreLivre"=>"ASC"]);
        $theme=$themeRepo->findBy([],["themeLivre"=>"ASC"]);
        return $this->render('livre/index.html.twig', [
            'livre'=>$livre,
            'theme'=>$theme,
        ]);
    }

    /**
     * @Route("/livre/new",name="newLivre")
     */
    public function newLivre(Request $request, EntityManagerInterface $em, SluggerInterface $slugger)
    {
        $livre=new Livre();
        $form=$this->createForm(LivreFormType::class,$livre);
        $form->HandleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $imagefile=$form->get('imageLivre')->getData();
            if ($imagefile)
            {
                $originalFilename = pathinfo($imagefile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = '/uploads/images/'.$safeFilename.'-'.uniqid().'.'.$imagefile->guessExtension();
                $livre->setImageLivre($newFilename);
            }
            $livre->setDateAjout(new \DateTime());
            $em->persist($livre);
            $em->flush();
            if($imagefile)
            {
                $imagefile->move($this->getParameter('images_directory'),$newFilename);
            }
            $this->addFlash('message','Nouveau livre ajouté avec succès !');
            return $this->redirectToRoute('livre');
        }
        return $this->render('livre/newLivre.html.twig',[
            'livre'=>$livre,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/livre/{id}",name="showLivre")
     */
    public function showLivre(Livre $livre)
    {
        return $this->render('livre/showLivre.html.twig', [
            'livre'=>$livre,
        ]);
    }

    /**
     * @Route("/livre/{id}/edit",name="editLivre")
     */
    public function editLivre(Livre $livre, Request $request, EntityManagerInterface $em, SluggerInterface $slugger): Response
    {
        $form=$this->createForm(LivreFormType::class,$livre);
        $form->HandleRequest($request);
        if( $form->isSubmitted() && $form->isValid())
        {
            $imagefile=$form->get('imageLivre')->getData();
            if ($imagefile)
            {
                $originalFilename = pathinfo($imagefile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = '/uploads/images/'.$safeFilename.'-'.uniqid().'.'.$imagefile->guessExtension();
                $livre->setImageLivre($newFilename);
            }
            $em->persist($livre);
            $em->flush();
            if($imagefile)
            {
                $imagefile->move($this->getParameter('images_directory'),$newFilename);
            }
            $this->addFlash('message','Livre Modifié avec succès !');
            return $this->redirectToRoute('livre');
        }
        return $this->render('livre/editLivre.html.twig',[
            'livre'=>$livre,
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/livre/{id}/delete",name="deleteLivre")
     */
    public function deleteLivre(Livre $livre,Request $request,EntityManagerInterface $em)
    {
        $em->remove($livre);
        $em->flush();
        $this->addFlash('message','Livre supprimé avec succès !');
        return $this->redirectToRoute('livre');
    }

    
}
