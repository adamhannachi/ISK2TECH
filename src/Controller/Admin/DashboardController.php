<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function user( ): Response
    {
        
     
     
        return $this->render('Admin/index.html.twig', [
            
          
        ]);

       
    }

   

   
}
