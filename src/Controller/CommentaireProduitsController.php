<?php

namespace App\Controller;

use App\Entity\Commentaires;
use App\Form\FormCommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CommentairesRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommentaireProduitsController extends AbstractController
{
    //route liste des commentaire
    #[Route('/commentaire/produits', name: 'app_commentaire_produits')]
    public function index(CommentairesRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
     $data = $repository->findAll();
     $Commentaire= $paginator->paginate(
            $data, $request->query->getInt('page', 1),
            10
        );

        return $this->render('commentaire_produits/index.html.twig', [
           'Commentaire'=> $Commentaire
        ]);
    }

    // supprimer commentaire
    #[Route('/supprimer/commentaire/{id}', name: 'delete_commentaire_produits',methods:['GET'])]
    public function delete(CommentairesRepository $repository,int $id ,EntityManagerInterface $manager ): Response
    {
        $Commentaire = $repository->findOneBy(['id'=> $id]);
        $manager->remove($Commentaire);
        $manager->flush();
    
        return $this->redirectToRoute('app_commentaire_produits');
    }

    //formulaire commentaire clientel
    

     #[Route('/creer/commentaire', name: 'creer_commentaire', methods:['GET','POST'])]
     public function create( Request $request, EntityManagerInterface $manager ): Response
     {
         $Commentaire= new Commentaires();
         $formCommentaire = $this->createForm(FormCommentaireType::class, $Commentaire);
 
         $formCommentaire ->handleRequest($request);
         if($formCommentaire ->isSubmitted() && $formCommentaire ->isValid()){
            $Commentaire= $formCommentaire ->getData();
 
            $manager->persist($Commentaire);
            
            $manager->flush();
         }
         return $this->render('commentaire_produits/formulaire_commentaire.html.twig', [
             'formCommentaire'=> $formCommentaire->createView(),
             'Commentaire'=> $Commentaire
             
         ]);
     
     }
}
