<?php

namespace App\Controller;

use App\Entity\Accessoires;
use App\Form\FormAccessoireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AccessoiresRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CrudAccessoireController extends AbstractController
{
    #[Route('/list/accessoire', name: 'app_accessoire', methods:['GET','POST'])]
    public function index(AccessoiresRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $data= $repository->findAll();
        $Accessoire = $paginator->paginate(
            $data, $request->query->getInt('page', 1),
            10
        );
        return $this->render('crud_accessoire/index.html.twig', [
          'Accessoire'=> $Accessoire
        ]);
    }

    
    //  créer un nouveau Accessoire

    #[Route('/creer/accessoire', name: 'creer_acessoire', methods:['GET','POST'])]
    public function create( Request $request, EntityManagerInterface $manager ): Response
    {
        $Accessoire= new Accessoires();
        $formAccessoire = $this->createForm(FormAccessoireType::class, $Accessoire);

        $formAccessoire->handleRequest($request);
        if($formAccessoire->isSubmitted() && $formAccessoire->isValid()){
           $Accessoire= $formAccessoire->getData();

           $manager->persist($Accessoire);
           
           $manager->flush();
        }
        return $this->render('crud_accessoire/CreeAccessoires.html.twig', [
            'formAccessoire'=> $formAccessoire->createView(),
            
        ]);
    
    }


     //  modifier Accessoires

     #[Route('/modifier/accessoire/{id}', name:'modifier_accessoire', methods:['GET','POST'])]
     public function update(AccessoiresRepository $repository,int $id ,Request $request, EntityManagerInterface $manager ): Response
     {
        $Accessoire = $repository->findOneBy(['id'=>$id]);
        $formAccessoire= $this->createForm(FormAccessoireType::class,$Accessoire);
        
        $formAccessoire->handleRequest($request);
        if($formAccessoire->isSubmitted() && $formAccessoire->isValid()){
            $Accessoire= $formAccessoire->getData();
          
           $manager->persist($Accessoire);
           
           $manager->flush();
         
        }
        
         return $this->render('crud_accessoire/ModifierAccessoires.html.twig', [
            'formAccessoire'=>$formAccessoire->createView(),
             
         ]);
     
     }

     
     //  supprimer Accessoire

     #[Route('/supprimer/accessoire/{id}', name: 'delete_accessoire', methods:['GET','POST'])]
     public function delete(AccessoiresRepository $repository,int $id , EntityManagerInterface $manager): Response
     {
 
        $Accessoire = $repository->findOneBy(['id'=> $id]);
        $manager->remove($Accessoire);
        $manager->flush();
       
        $this->addFlash(
            'success',
            'votre accessoire a été bien supprimé dans le système',
        );
        return $this->redirectToRoute('app_accessoire');
        
     
     }

     

    #[Route('/produit/accessoire', name: 'produit_accessoire', methods:['GET','POST'])]
    public function accessoire(AccessoiresRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $data= $repository->findAll();
        $Accessoire = $paginator->paginate(
            $data, $request->query->getInt('page', 1),
            12
        );
        return $this->render('accessoires/index.html.twig', [
          'Accessoire'=> $Accessoire
        ]);
    }

        
     

    }