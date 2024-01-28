<?php

namespace App\Controller;

use App\Repository\OrdinateurRepository;
use App\Repository\SmartPhoneRepository;
use App\Repository\AccessoiresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailsProduitsController extends AbstractController
{
    #[Route('/details/produits/smartphone/{id}', name: 'details_produits_smart', methods:['GET'])]
    public function detailSmartphone(SmartPhoneRepository $SmartPhonerepository, int $id, ): Response
    {
        
        $SmartPhone= $SmartPhonerepository->findOneBy(['id'=>$id]);
        
        return $this->render('details_produits/smartphone.html.twig', [
            'SmartPhone' => $SmartPhone,
           
           
        ]);
    }

    #[Route('/details/produits/ordinateur/{id}', name: 'details_produits_ordinateur', methods:['GET'])]
    public function detailOrdinateur( OrdinateurRepository $Ordinateurrepository ,int $id, ): Response
    {
          
        $Ordinateur=  $Ordinateurrepository ->findOneBy(['id'=>$id]);

        
        return $this->render('details_produits/ordinateur.html.twig', [
            'Ordinateur' => $Ordinateur
            
        ]);
    }

    #[Route('/details/produits/accessoire/{id}', name:'details_produits_accessoire', methods:['GET'])]
    public function detailAccessoire(AccessoiresRepository $Accessoiresrepository, int $id, ): Response
    {
        
        $Accessoire=  $Accessoiresrepository->findOneBy(['id'=>$id]);
        
        
        return $this->render('details_produits/accessoire.html.twig', [
            'Accessoire' => $Accessoire
            
        ]);
    }


    
}
