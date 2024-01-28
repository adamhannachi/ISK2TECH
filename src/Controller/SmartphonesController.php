<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchForm;
use App\Repository\SmartPhoneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SmartphonesController extends AbstractController
{
    #[Route('/smartphones', name:'app_smartphones',methods:['GET','POST'])]
    public function index(SmartPhoneRepository $repository, Request $request): Response
    {
       $data = new SearchData();
       $data->page = $request->get('page', 1);
       $form = $this->createForm(SearchForm ::class , $data);
       $form->handleRequest($request);
        $smartPhone = $repository->findSearch($data);
        return $this->render('smartphones/index.html.twig', [
            'smartPhone' => $smartPhone,
            'form'=> $form->createView(),
            
           
        ]);
    }
}
