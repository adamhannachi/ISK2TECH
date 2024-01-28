<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilterController extends AbstractController
{
    #[Route('/filter', name: 'app_filter')]
    public function index(): Response
    {
        return $this->render('filter/index.html.twig', [
            'controller_name' => 'FilterController',
        ]);
    }
}
