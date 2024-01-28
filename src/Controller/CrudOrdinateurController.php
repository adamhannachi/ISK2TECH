<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Entity\Ordinateur;
use App\Form\FormOrdinateurType;
use App\Repository\OrdinateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CrudOrdinateurController extends AbstractController
{
    #[Route('/list/ordinateur', name: 'app_crud_ordinateur')]
    public function index(OrdinateurRepository $repository, PaginatorInterface $paginator , Request $request): Response
    {
        
        $data = $repository->findAll();
        $ordinateur =  $paginator->paginate(
            $data, $request->query->getInt('page', 1),
            10
        );
        return $this->render('crud_ordinateur/index.html.twig', [
           'ordinateur' => $ordinateur
        ]);
    }

    //  créer un nouveau produits ordinateur

    #[Route('/cree/ordinateur', name: 'creer_ordinateur', methods:['GET','POST'])]
    public function create( Request $request, EntityManagerInterface $manager ): Response
    {
     
        $ordinateur= new Ordinateur();
        $formordinateur = $this->createForm(FormOrdinateurType::class, $ordinateur);

        $formordinateur->handleRequest($request);
        if($formordinateur->isSubmitted() &&$formordinateur->isValid()){
           $ordinateur= $formordinateur->getData();

           $manager->persist($ordinateur);
           
           $manager->flush();
           $this->addFlash(
            'success',
            'votre Produit a été bien rajouté dans le système',

           );
         
        }
       
        return $this->render('crud_ordinateur/CreerOrdinateurs.html.twig', [
        'formordinateur'=> $formordinateur->createView(),
            
        ]);
    
    }


     //  modifier produits ordinateur

     #[Route('/modifier/ordinateur/{id}', name: 'modifier_ordinateur', methods:['GET','POST'])]
     public function edit(OrdinateurRepository $repository,int $id ,Request $request, EntityManagerInterface $manager ): Response
     {
        $ordinateur= $repository->findOneBy(['id'=>$id]);
        $formordinateur= $this->createForm(FormOrdinateurType::class, $ordinateur);
        
        $formordinateur->handleRequest($request);
        if($formordinateur->isSubmitted() && $formordinateur->isValid()){
        $ordinateur =$formordinateur->getData();
          
           $manager->persist($ordinateur);
           
           $manager->flush();
          
         
        }
        
         return $this->render('crud_ordinateur/ModifierOrdinateurs.html.twig', [
            'formordinateur'=>$formordinateur->createView(),
             
         ]);
     
     }



     
     //  supprimer produits ordinateur

     #[Route('/supprimer/ordinateur/{id}', name: 'delete_ordinateur', methods:['GET','POST'])]
     public function delete(OrdinateurRepository $repository,int $id , EntityManagerInterface $manager ): Response
     {
 
        $ordinateur= $repository->findOneBy(['id'=>$id]);
        $manager->remove($ordinateur);
        $manager->flush();
        $this->addFlash(
            'success',
            'votre produit a été bien supprimé dans le système',
        );
        return $this->redirectToRoute('app_crud_ordinateur');
        
     
     }

     #[Route('/ordinateur', name:'produit_ordinateur',methods:['GET','POST'])]
     public function view(OrdinateurRepository $repository, Request $request): Response
     {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm ::class , $data);
        $form->handleRequest($request);
         $ordinateur = $repository->findSearch($data);
         return $this->render('ordinateur/indexOrdinateur.html.twig', [
             'ordinateur' => $ordinateur,
             'form'=> $form->createView(),
             
            
         ]);
     }
   
}
