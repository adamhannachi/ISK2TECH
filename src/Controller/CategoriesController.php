<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\FormCategorieType;
use App\Repository\CategoriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoriesController extends AbstractController
{
    #[Route('/list/categories', name: 'app_categories')]
    public function index(CategoriesRepository $repository, Request $request,PaginatorInterface $paginator): Response
    {
       
        $data= $repository->findAll();
        $Categorie = $paginator->paginate(
            $data, $request->query->getInt('page', 1),
            10
        );
        return $this->render('categories/index.html.twig', [
           'Categorie' => $Categorie,
          
        ]);
    }


    // cree un nouveau catégorie
    #[Route('/creer/categories', name: 'creer_categorie', methods:['GET','POST'])]
    public function create( Request $request, EntityManagerInterface $manager ): Response
    {
        
        $Categorie= new Categories();
        $formCategorie= $this->createForm(FormCategorieType::class, $Categorie);

        $formCategorie->handleRequest($request);
        if($formCategorie->isSubmitted() &&  $formCategorie->isValid()){
           $Categorie =  $formCategorie->getData();

           $manager->persist($Categorie);
           
           $manager->flush();

           return $this->redirectToRoute('app_categories');
        }

        return $this->render('categories/creer_categorie.html.twig', [
            'formCategorie'=> $formCategorie->createView(),
            
        ]);
    }

     // modifier catégorie
     #[Route('/modifier/categories/{id}', name: 'modifier_categorie', methods:['GET','POST'])]
     public function update(CategoriesRepository $repository, Request $request, EntityManagerInterface $manager, int $id): Response
     {
         
        $Categorie= $repository->findOneBy(['id'=>$id]);
         $formCategorie= $this->createForm(FormCategorieType::class, $Categorie);
 
         $formCategorie->handleRequest($request);
         if($formCategorie->isSubmitted() &&  $formCategorie->isValid()){
            $Categorie =  $formCategorie->getData();
 
            $manager->persist($Categorie);
            
            $manager->flush();
            return $this->redirectToRoute('app_categories');
         }
         return $this->render('categories/modifier_categorie.html.twig', [
             'formCategorie'=> $formCategorie->createView(),
         ]);
     }

      
     //  supprimer catégorie

     #[Route('/supprimer/accessoire/{id}', name: 'delete_categorie', methods:['GET','POST'])]
     public function delete(CategoriesRepository $repository,int $id , EntityManagerInterface $manager): Response
     {
 
        $Categorie = $repository->findOneBy(['id'=> $id]);
        $manager->remove($Categorie);
        $manager->flush();
       
        $this->addFlash(
            'success',
            'votre Catégorie a été bien supprimé dans le système',
        );
        return $this->redirectToRoute('app_categories');
        
     
     }
}

