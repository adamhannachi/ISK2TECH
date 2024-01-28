<?php

namespace App\Controller;

use App\Repository\SmartPhoneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier', methods:['GET', 'POST'])]
    public function index(SessionInterface $session, SmartPhoneRepository $smartPhoneRepository): Response
    {
        $panier = $session->get("panier", []);

        // j'ai fabriqué les données
        $dataPanier=[];
        $total = 0;

        foreach($panier as $id => $quantite){
          $smartphone= $smartPhoneRepository->find($id);
          $dataPanier[] =[
            "smartPhone" =>$smartphone,
            "quantite"   => $quantite
          ];
          $total += $smartphone->getprix($id) * $quantite;
        }

        return $this->render('panier/index.html.twig', compact("dataPanier","total"));
    }

/*** route add pour rajouter des produits au panier */
    #[Route('/panierSmartPhone/rajouter/{id}', name: 'app_rajouter', methods:['GET','POST'])]
    public function add($id, SessionInterface $session): Response
    {
       
      //je récuperé panier acutel 
      $panier = $session->get("panier" , []);
       if(!empty($panier[$id])){
          $panier[$id]++;
       }else{
          $panier[$id] = 1;
       }
       // j'ai suvgardé dans la session
         $session->set("panier", $panier);

         return $this->redirectToRoute("app_panier");
       
    }


    /*** route modifier  produits au panier */
    #[Route('/panierSmartPhone/modifier/{id}', name: 'app_modifier', methods:['GET','POST'])]
    public function edit($id, SessionInterface $session): Response
    {
       
      //je récuperé panier acutel 
      $panier = $session->get("panier" , []);
       if(!empty($panier[$id])){
        if($panier[$id] > 1){
            $panier[$id]--;
        }else{
            unset($panier[$id]);
        }
          
       }
       // j'ai suvgardé dans la session
         $session->set("panier", $panier);

         return $this->redirectToRoute("app_panier");
       
    }


    
    /*** route supprimer  produits au panier */
    #[Route('/panierSmartPhone/supprimer/{id}', name: 'app_supprimer', methods:['GET','POST'])]
    public function delete($id, SessionInterface $session): Response
    {
       
      //je récuperé panier acutel 
      $panier = $session->get("panier" , []);
       if(!empty($panier[$id])){
        
            unset($panier[$id]);
        }
          
       // j'ai suvgardé dans la session
         $session->set("panier", $panier);

         return $this->redirectToRoute("app_panier");
       
    }


     /*** route supprimer tous  produits au panier */
     #[Route('/supprimer', name: 'supprimer_tous', methods:['GET','POST'])]
     public function deleteAll( SessionInterface $session): Response
     {
        
      
          $session->set("panier" ,[]);
 
          return $this->redirectToRoute("app_panier");
        
     }

}
