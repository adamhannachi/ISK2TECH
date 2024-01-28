<?php

namespace App\Controller;

use App\Entity\SmartPhone;
use App\Form\FormSmartPhoneType;
use App\Repository\SmartPhoneRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CrudSmartPhoneController extends AbstractController
{
    #[Route('/list/smartphone', name: 'app_crud_smart_phone', methods:['GET','POST'])]
    public function index(SmartPhoneRepository $repository, PaginatorInterface $paginator, Request $request ): Response
    {
        $data = $repository->findAll();
        $smartPhone =  $paginator->paginate(
            $data, $request->query->getInt('page', 1),
            10);
        return $this->render('crud_smart_phone/index.html.twig', ['smartPhone'=> $smartPhone]);}

    //  créer un nouveau produits smartphone

    #[Route('/cree/smartphone', name: 'creer_smart_phone', methods:['GET','POST'])]
    public function create( Request $request, EntityManagerInterface $manager): Response
    {
        
        $smartPhone= new SmartPhone();
        // j'ai créé un formulaire
        $formsmartPhone = $this->createForm(FormSmartPhoneType::class, $smartPhone);
         // j'ai tretait la requete de formulaire 
        $formsmartPhone->handleRequest($request);
        if($formsmartPhone->isSubmitted() && $formsmartPhone->isValid()){
           
           $smartPhone= $formsmartPhone->getData();
           $manager->persist($smartPhone);
           
           $manager->flush();
           $this->addFlash(
            'success',
            'votre Produit a été bien rajouté dans le système',
           );
        }
        return $this->render('crud_smart_phone/CreerSmartphones.html.twig', 
        ['formsmartPhone'=>$formsmartPhone->createView(),]);}


     //  modifier produits smartphone

     #[Route('/modifier/smartphone/{id}', name: 'modifier_smart_phone', methods:['GET','POST'])]
     public function edit(SmartPhoneRepository $repository,int $id ,Request $request, 
     EntityManagerInterface $manager ): Response
     {
 
        $smartPhone= $repository->findOneBy(['id'=>$id]);
        $formsmartPhone= $this->createForm(FormSmartPhoneType::class, $smartPhone);
        
        $formsmartPhone->handleRequest($request);
        if($formsmartPhone->isSubmitted() && $formsmartPhone->isValid()){
           $smartPhone =$formsmartPhone->getData();
           $manager->persist($smartPhone);
           $manager->flush();
         
        }
         return $this->render('crud_smart_phone/ModifierSmartphones.html.twig', [
            'formsmartPhone'=>$formsmartPhone->createView(),
             
         ]);
     
     }

     
     //  supprimer produits smartphone

     #[Route('/supprimer/smartphone/{id}', name: 'delete_smart_phone', methods:['GET','POST'])]
     public function delete(SmartPhoneRepository $repository,int $id , 
     EntityManagerInterface $manager ): Response
     {
        $smartPhone= $repository->findOneBy(['id'=>$id]);
        $manager->remove($smartPhone);
        $manager->flush();
        $this->addFlash(
            'success',
            'votre voiture a été bien supprimé dans le système',
        );
        return $this->redirectToRoute('creer_smart_phone');
         
    
 }
        
     
     }
